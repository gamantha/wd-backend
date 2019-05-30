<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Report;

class ReportIndicatorMap extends Model {

  protected $table = 'report_indicator_map';

  protected $fillable = [
    'indicator_id', 'report_template_id', 'order'
  ];
}
