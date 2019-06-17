<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\ReportTemplate;
use App\Http\Models\IndicatorValue;
use App\Http\Models\Indicator;
use App\Http\Models\ReportIndicatorMap;

class Report extends Model
{

    protected $table = 'report';
    protected $appends = ['template'];

    protected $fillable = [
        'name', 'report_template_id', 'author_id', 'report_date', 'status'
    ];

    public function template()
    {
        return $this->hasOne(ReportTemplate::class, 'id', 'report_template_id');
    }

    public function getTemplateAttribute()
    {
        return  $this->template()->first();
    }

    public function indicatorValues()
    {
        return $this->hasMany(IndicatorValue::class, 'report_id', 'id');
    }
}
