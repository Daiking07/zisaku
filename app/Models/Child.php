<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $guarded = ['id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
