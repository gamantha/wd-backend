<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChartIndicator extends Pivot {

    protected $table = 'chart_indicator';

    protected $fillable = [
        'chart_id', 'indicator_id'
    ];

    public function indicator()
    {
        return $this->hasOne(Indicator::class);
    }

    public function chart()
    {
        return $this->hasOne(Chart::class);
    }

}
