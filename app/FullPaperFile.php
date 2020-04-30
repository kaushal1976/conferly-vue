<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FullPaperFile extends Model
{
    protected $fillable = [

        'description',
        'file'
    ];

    public function paper() {

        return $this->belongsTo(PaperFullPaper::class);

    }
}
