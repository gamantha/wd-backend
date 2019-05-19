<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Report;

class ReportTemplate extends Model {

  protected $table = 'report_template';

  protected $fillable = [
    'name', 'label', 'author_id'
  ];

  public function report()
  {
      return $this->belongsTo('App\Http\Models\Report');
  }
}
