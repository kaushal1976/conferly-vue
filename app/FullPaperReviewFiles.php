<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FullPaperReviewFiles extends Model
{
    protected $fillable = [

        'file',

        'description'
    ];

    public function fullPaperReview() {

        return $this->belongsTo(FullPaperReview::class);
    }
}
