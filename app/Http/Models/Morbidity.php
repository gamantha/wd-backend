<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Morbidity extends Model {

  protected $table = 'morbidity';

  protected $fillable = [
    'cause', 'gender', 'age', 'report_id'
  ];

}
