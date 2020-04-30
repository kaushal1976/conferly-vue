<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presenter extends Model
{
    protected $fillable = [

        'biography'
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }
}
