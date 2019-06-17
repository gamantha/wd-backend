<?php

namespace App\Http\Services;

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
}
