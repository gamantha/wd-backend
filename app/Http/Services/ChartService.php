<?php

namespace App\Http\Services;

use DB;
use Carbon\Carbon;
use App\Http\Models\Chart;
use App\Http\Models\ChartIndicator;

/**
 * ChartService manage chart tables
 */
class ChartService extends BaseService {
 
  function __construct($model) {
    parent::__construct($model);
  }

  /**
   * SaveChart save chart and its indicators in transactions save
   * @param request request object that has passed validation
   * @return Chart created chart object
   * @throw error if transaction fail
   * note: reattempt to execute transaction 5 times before throwing deadlock
   */
  public function saveChart($request) {
    DB::beginTransaction();
    try {
        $chart = new Chart();
        $chart->user_id = $request->auth->username;
        $chart->from = $request->input('from');
        $chart->to = $request->input('to');
        $chart->interval = $request->input('interval');
        $chart->options_json = $request->input('options_json');
        $chart->save();
        // loop through its indicators
        foreach($request->indicator_ids as $iid) {
            $chart_indicator = new ChartIndicator();
            $chart_indicator->chart_id = $chart->id;
            $chart_indicator->indicator_id = $iid;
            $chart_indicator->save();
        }
        DB::commit();
        return $chart;
    } catch (\Throwable $th) {
        DB::rollBack();
        throw $th;
    }
  } 

  function get($page = 1, $limit = 10, $condition=[], $sort=['created_at', 'DESC']) {
    $total = $this->model::count();
    $data = $this->model::with('indicatorValue.indicator')
        ->where($condition)
        ->limit($limit)
        ->offset(($page-1)*$limit)
        ->orderBy($sort[0], $sort[1])
        ->get();
    $result = [];
    foreach($data as $chart) {
        $chartIndicatorsCollection = collect($chart->indicatorValue);
        $chartIndicators = $chartIndicatorsCollection->whereBetween('created_at', [$chart->from, $chart->to]);
        $groupedIndicators = $chartIndicators->sortBy('created_at')->groupBy(
            function($d) {
                return Carbon::parse($d->created_at)->format('m');
            }
        );
        $chart->indicators = $groupedIndicators;
        unset($chart->indicatorValue);
        array_push($result, $chart);
    }
    return [
      'total' => $total,
      'data' => $result,
    ];
  }
}
