<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperPresentation extends Model
{
    protected $fillable = [

        'file',

    ];

    public function presenter() {

        //return $this->belongsTo()

    }

    public function paper() {

        return $this->belongsTo(Paper::class);
    }
}
