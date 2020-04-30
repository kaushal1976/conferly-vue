<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FullPaperReview extends Model
{
    protected $fillable = [

        'comments',

        'recommendation',

        'score',

    ];

    public function reviewer() {

        return $this->belongsTo(Reviewer::class);
    }

    public function fullPaperReviewFiles() {

        return $this->hasMany(FullPaperReviewFiles::class);
    }


}
