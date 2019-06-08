<?php

namespace App\Http\Services;

/**
 * BaseService class that provide basic CRUD functionality.
 */
class BaseService {

  protected $model = null;

  function __construct($model) {
    $this->model = $model;
  }

  /**
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
    $data = $this->model::where($condition)->limit($limit)->offset(($page-1)*$limit)->orderBy($sort[0], $sort[1])->get()->toArray();
    return [
      'total' => $total,
      'data' => $data,
    ];
  }

  /**
   * find by id, default implementation of finding single row
   * @param $id Mix any value of the table id
   * @return ['data']
   */
  function find($id) {
    return $this->model::where(['id' => $id])->first();
  }

  /**
   * save or update record
   * @param $payload Mix
   * @return Array
   */
  function save($payload) {
    $payload->save();
    return $payload;
  }

  /**
   * delete row
   * @param $id model id
   */
  function delete($id) {
    $data = $this->find($id);
    if ($data) {
      $data->delete();
      return true;
    }
    return false;
  }

}
