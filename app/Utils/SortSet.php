<?php

namespace App\Utils;

use Illuminate\Http\Request;

class SortSet {
  /**
   * @param Request $request
   * @param string $default_sort_by
   * @return array [sort, order, key] ex. ['-id', 'desc', '-id']
   */
  static public function getSet(Request $request, string $default_sort_by='-id') {
    // ex. '-id' or 'id'
    $sort = $request->sort != null ? $request->sort : $default_sort_by;

    $order = substr($sort, 0, 1) == '-' ? 'desc' : 'asc';
    $key = substr($sort, 0, 1) == '-' ? substr($sort, 1) : $sort;

    return [
      $sort,
      $order,
      $key,
    ];
  }
}
