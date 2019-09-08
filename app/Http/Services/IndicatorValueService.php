<?php

namespace App\Http\Services;

use DB;
use App\Http\Models\IndicatorValue;
use App\Http\Models\Report;
use App\Http\Services\ReportService;


/**
 * IndicatorValueService manage report value
 */
class IndicatorValueService extends BaseService {

    private $reportService;

    function __construct($model) {
        parent::__construct($model);
        $this->reportService = new ReportService(new Report);
    }

    /**
     * updateValues take in indicators (array of [indicatorID => value])
     * and update every indicator passed in
     * @return none
     */
    function updateValues($indicators) {
        DB::beginTransaction();
        try {
            foreach ($indicators as $indicator) {
                $ind = IndicatorValue::where('id', $indicator['id'])->first();
                if (!$ind) {
                    DB::rollBack();
                    throw new \Exception('one of the indicator not found: ' . ' id: ' . $indicator['id']);
                }
                $ind->value = $indicator['value'];
                $ind->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    /**
     * insert multiple report values
     * @param values
     */
    function insertValues($values, $indicators, $report_id, $status) {
        $indicatorIds = array_column($indicators->toArray(), 'id');
        // make sure the submited indicator is correct as the report's template
        foreach ($values as $value) {
            if (!in_array($value['indicator_id'], $indicatorIds)) {
                // throw error if does not match
                throw new \Exception("InvalidIndicator", 1);
            }
        }
        // get indicator values of report if exist
        $reportIndicators = IndicatorValue::where([['report_id', $report_id]])->get();
        if (count($reportIndicators) > 0) {
            // update
            $indicatorIds = array_column($reportIndicators->toArray(), 'indicator_id');
            \DB::transaction(function() use ($values, $indicatorIds, $report_id, $status) {
                foreach ($values as $value) {
                    if (in_array($value['indicator_id'], $indicatorIds)) {
                        $indicatorValue = IndicatorValue::where([['indicator_id', $value['indicator_id'], ['report_id', $report_id]]])->first();
                        $indicatorValue->value = $value['indicator_value'];
                        $indicatorValue->save();
                    } else {
                        // new field, it's ok to add the new field here, we already checked with the template before.
                        $indicatorValue = new IndicatorValue();
                        $indicatorValue->value = $value['indicator_value'];
                        $indicatorValue->indicator_id = $value['indicator_id'];
                        $indicatorValue->report_id = $report_id;
                        $indicatorValue->save();
                    }
                }
                $report = $this->reportService->find($report_id);
                $report->status = $status ?: 1;
                $this->reportService->save($report);
            });
        } else {
            // run in db-transaction in case on of indicators fail
            \DB::transaction(function() use ($values, $indicatorIds, $report_id, $status) {
                foreach ($values as $value) {
                    if (in_array($value['indicator_id'], $indicatorIds)) {
                        $indicatorValue = new IndicatorValue();
                        $indicatorValue->value = $value['indicator_value'];
                        $indicatorValue->indicator_id = $value['indicator_id'];
                        $indicatorValue->report_id = $report_id;
                        
                        $indicatorValue->save();
                    } else {
                        // roll back when fail
                        \DB::rollBack();
                        \Log::warning("invalid indicator provided : rolling back applied changes");
                        throw new \Exception("InvalidIndicator", 1);
                    }
                }
                $report = $this->reportService->find($report_id);
                $report->status = $status ?: 1;
                $this->reportService->save($report);
            });
        }
    }

}
