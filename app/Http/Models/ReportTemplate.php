<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model {

  protected $table = 'report_template';

  protected $fillable = [
    'name', 'label', 'author_id'
  ];

}