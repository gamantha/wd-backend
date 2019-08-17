<?php

namespace App\Http\Services;

use DB;
use App\Http\Models\ReportTemplate;
use App\Http\Models\ReportIndicatorMap;


/**
 * ReportTemplateService manage report_template
 */
class ReportTemplateService extends BaseService {

  function __construct($model) {
    parent::__construct($model);
  }

  function get($page = 1, $limit = 10, $condition=[], $sort=['created_at', 'DESC']) {
    $total = $this->model::count();
    $data = $this->model::where($condition)->limit($limit)->offset(($page-1)*$limit)
      ->orderBy($sort[0], $sort[1])
      ->with(['indicators'])
      ->get()->toArray();
    return [
      'total' => $total,
      'data' => $data,
    ];
  }

  function find($id) {
    return $this->model::where(['id' => $id])->with(['indicators'])->first();
  }

  /**
   * save report template along with validating the existance of the submitted indicator id
   * throught the db relation
   * @param request request object
   */
    public function saveReportTemplate($request) {
        DB::beginTransaction();
        try {
            $report_template = new ReportTemplate();
            $report_template->name = $request->input('name');
            $report_template->label = $request->input('label');
            $report_template->report_type = $request->input('report_type');
            $report_template->author_id = $request->auth->username;
            $report_template->save();
            // loop through its indicators
            for ($i=0; $i < count($request->indicator_ids); $i++) { 
                $report_indicator = new ReportIndicatorMap();
                $report_indicator->report_template_id = $report_template->id;
                $report_indicator->indicator_id = $request->indicator_ids[$i];
                $report_indicator->category_id = $request->category_ids[$i];
                $report_indicator->order = $i + 1;
                $report_indicator->save();
            }
            DB::commit();
            return $report_template;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    } 

    /**
     * update report template
     * @param request object
     * @param report_template fetched report template (eloquent)
     * @param id id of the report template to update
     * @return ReportTemplate updated value
     */
    public function updateReportTemplate($request, $report_template, $id) {
        DB::beginTransaction();
        try {
            // update
            $report_template = ReportTemplate::with('indicators')->where('id', $id)->first();
            $report_template->name = $request->input('name');
            $report_template->label = $request->input('label');
            $report_template->report_type = $request->input('report_type');
            $report_template->author_id = $request->auth->username;
            $report_template->save();
            // delete all previous linked indicator_ids
            foreach ($report_template->indicators as $indicator) {
                ReportIndicatorMap::where([
                    'report_template_id' => $id,
                    'indicator_id' => $indicator->id,
                ])->delete();
            }
            // insert new ids
            for ($i = 0; $i < count($request->indicator_ids); $i++) {
                $report_indicator = new ReportIndicatorMap();
                $report_indicator->report_template_id = $report_template->id;
                $report_indicator->indicator_id = $request->indicator_ids[$i];
                $report_indicator->category_id = $request->category_ids[$i];
                $report_indicator->order = $i + 1;
                $report_indicator->save();
            }
            // success all commit
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    } 
}
