<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model {

    protected $table = 'chart';

    protected $fillable = [
        'user_id', 'from', 'to', 'interval', 'options_json'
    ];
}
