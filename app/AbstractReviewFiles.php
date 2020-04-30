<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbstractReviewFiles extends Model
{
    protected $fillable = [

        'file',

        'description'

    ];

    public function abstractReview() {

        return $this->belongsTo(AbstractReview::class);
    }
}
