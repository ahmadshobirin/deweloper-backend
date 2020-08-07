<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creation extends Model
{
    protected $table = 'creation';

    protected $guarded = ['id'];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
