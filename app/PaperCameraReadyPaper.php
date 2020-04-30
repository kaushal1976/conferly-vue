<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperCameraReadyPaper extends Model
{
    protected $fillable = [

        'file',

        'approved',

    ];

    public function paper() {

        return $this->belongsTo(Paper::class);
    }
}
