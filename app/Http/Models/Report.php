<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\ReportTemplate;

class Report extends Model
{

    protected $table = 'report';
    protected $appends = ['template'];

    protected $fillable = [
        'name', 'report_template_id', 'author_id', 'report_date', 'status'
    ];

    public function template()
    {
        return $this->belongsTo(ReportTemplate::class, 'report_template_id');
    }

    public function getTemplateAttribute()
    {
        return  $this->template()->first();
    }
}
