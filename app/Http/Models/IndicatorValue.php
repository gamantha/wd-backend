<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Report;

class IndicatorValue extends Model {

    protected $table = 'indicator_value';

    protected $fillable = [
        'value', 'report_id', 'indicator_id'
    ];

    public function indicator()
    {
        return $this->hasOne('App\Http\Models\Indicator', 'id', 'indicator_id');
    }

    public function report()
    {
        return $this->hasOne('App\Http\Models\Report');
    }

}
