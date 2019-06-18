<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

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

    // public function indicators()
    // {
        // return $this->belongsToMany(Indicator::class, ReportIndicator);
    // }
}
