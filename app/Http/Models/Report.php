<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $table = 'report';

    protected $fillable = [
        'name', 'report_template_id', 'author_id', 'report_date', 'status'
    ];

    public function template()
    {
        return $this->belongsTo('App\Models\Http\ReportTemplate');
    }
}
