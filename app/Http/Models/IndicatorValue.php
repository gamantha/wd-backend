<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class IndicatorValue extends Model {

    protected $table = 'indicator_value';

    protected $fillable = [
        'value', 'report_id', 'indicator_id'
    ];

    public function indicator()
    {
        return $this->hasOne(Indicator::class, 'id', 'indicator_id');
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

}
