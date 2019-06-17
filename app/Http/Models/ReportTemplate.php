<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Report;
use App\Http\Models\ReportIndicatorMap;
use App\Http\Models\Indicator;

class ReportTemplate extends Model {

  protected $table = 'report_template';

  protected $fillable = [
    'name', 'label', 'author_id'
  ];

  public function report()
  {
      return $this->hasOne(Report::class, 'report_template_id');
  }

  public function indicators()
  {
    return $this->belongsToMany(Indicator::class, ReportIndicatorMap::class, 'report_template_id', 'indicator_id')->withPivot('order');
  }

}
