<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\ReportTemplate;
use App\Http\Models\IndicatorValue;

class Indicator extends Model {

  protected $table = 'indicator';

  protected $fillable = [
    'name', 'label', 'unit_label'
  ];


  public function reportTemplates()
  {
    return $this->belongsToMany(App\Http\Models\ReportTemplate::class, 'report_indicator_map');
  }

}