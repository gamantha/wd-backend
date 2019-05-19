<?php

namespace App\Http\Services;

/**
 * ReportService manage report
 */
class ReportService extends BaseService
{

    protected $model;

    function __construct($model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function get($page = 1, $limit = 10, $condition = [], $sort = ['created_at', 'DESC'])
    {
        $reports = $this->model->where($condition)->limit($limit)->offset(($page - 1) * $limit)->orderBy($sort[0], $sort[1])->get();
        $total = $this->model::count();

        return [
            'total' => $total,
            'data' => $reports,
        ];
    }
}
