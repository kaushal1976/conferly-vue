<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbstractReview extends Model
{
    protected $fillable = [

        'comments',

        'recommendation',

        'score',

    ];

    public function reviewer() {

        return $this->belongsTo(Reviewer::class);
    }

    public function paperAbstract() {

        return $this->belongsTo(PaperAbstract::class);
    }

    public function abstractReviewFiles() {

        return $this->hasMany(AbstractReviewFiles::class);
    }

}
