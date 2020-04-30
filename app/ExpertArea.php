<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpertArea extends Model
{
    protected $fillable = [

        'description'

    ];

    public function reviewers() {

        return $this->belongsToMany(Reviewer::class)->withTimestamps();
    }
}
