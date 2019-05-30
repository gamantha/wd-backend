<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model {

  protected $table = 'indicator';

  protected $fillable = [
    'name', 'label', 'unit_label'
  ];


  public function reportTemplates()
  {
    return $this->belongsToMany('App\Http\Models\ReportTemplate', 'report_indicator_map');
  }
}