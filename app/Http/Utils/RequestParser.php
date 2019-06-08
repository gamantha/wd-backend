<?php 

namespace App\Http\Utils;

/**
 * RequestParser Utility
 */
class RequestParser {

  // request example
  // /resource?filters[a]=a&filters[date][between]=dateFrom, dateTo&filters[price][<=]=100
  // /resource?sort=-price or /resource?sort=price => - indicate descending sorting, while the first one indicate ascending sorting 

  /**
   * parseFilter parse filter passed via the query-string
   * @param $filter Array
   * @return filter
   */
  static public function parseFilter($filter) {
    $filters = [];
    array_walk($filter, function ($value, $key) use (&$filters) {
      if (is_array($value)) {
        $k = key($value); // second array key
        if (key($value) == 'between') {
          $dates = explode(', ', $value[$k]);
          array_push($filters, [$key, '>=', $dates[0]]); // from
          array_push($filters, [$key, '<=', $dates[1]]); // to
        } else {
          array_push($filters, [$key, $k, $value[$k]]);
        }
      } else {
        array_push($filters, [$key, $value]);
      }
    });
    return $filters;
  }

  /**
   * parseSort parse sort passed via query-string
   * @param $sort array
   * @return sort
   */
  static public function parseSort($sort) {
    if ($sort[0] == '-') {
      return [substr($sort, 1), 'DESC'];
    }
    return [$sort, 'ASC'];
  }
}
