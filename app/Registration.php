<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [

        'invoice',

        'basis'

    ];

    public function presenter() {

        return $this->belongsTo(Presenter::class);
    }


}
