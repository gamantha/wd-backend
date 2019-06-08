<?php

namespace App\Http\Services;

/**
 * ReportService manage report
 */
class ReportService extends BaseService
{
    function __construct($model)
    {
        parent::__construct($model);
    }

    /**
    * override get method
    * get get all row paginated. Built resource url are: 
    * /resource?filters[key]=value&filters[keyA]=valueA&sort=-Field
    * @param $page Integer page number
    * @param $limit Integer maximum number of item to return
    * @param $condition [Array] conditional : ex: [["name", "Andy"], ["category_id", 1]]
    * @param $sort [Array['key', 'value']] sort by. value being either `ASC` or `DESC`
    * @return ['total', 'data']. total: total of row in the database
    */
    function get($page = 1, $limit = 10, $condition=[], $sort=['created_at', 'DESC']) {
        $total = $this->model::count();
        $data = $this->model::where($condition)->limit($limit)
            ->offset(($page-1)*$limit)->orderBy($sort[0], $sort[1])
            ->with(['template.indicators', 'indicatorValue'])
            ->get()->toArray();
        return [
            'total' => $total,
            'data' => $data,
        ];
    }

}
