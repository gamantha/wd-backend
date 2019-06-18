<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

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
    return $this->belongsToMany(Indicator::class, ReportIndicatorMap::class, 'report_template_id', 'indicator_id')->withPivot('order', 'category_id');
  }

  public function indicatorCategories()
  {
    return $this->belongsToMany(IndicatorCategory::class, ReportIndicatorMap::class, 'report_template_id', 'category_id');
  }

}
