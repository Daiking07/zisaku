<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = ['id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}

