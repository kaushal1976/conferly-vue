<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [

        'body',

    ];

    public function paperAbstract() {

        return $this->belongsTo(PaperAbstract::class);
    }
}
