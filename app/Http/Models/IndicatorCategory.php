<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class IndicatorCategory extends Model {

    protected $table = 'indicator_category';

    protected $fillable = [
        'name', 'label', 'parent_category_id'
    ];

    public function indicator()
    {
        return $this->belongsToMany(Indicator::class, ReportIndicatorMap::class, 'category_id', 'indicator_id');
    }
}
