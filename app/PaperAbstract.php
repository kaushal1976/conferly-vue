<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperAbstract extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    protected $fillable = [
        'body',
        'status',
        'outcome',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }

    public function abstractReviews()
    {
        return $this->hasMany(AbstractReview::class);
    }

    public function reviewers()
    {
        return $this->belongsToMany(Reviewer::class)->using(PaperAbstractReviewer::class);
    }

    public function scopeOfReviewer($query, $user)
    {
        $query->whereHas('reviewers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    public function scopeOfPaper($query, $paper)
    {
        return $query->where('paper_id', $paper->id);
    }

    public function conference()
    {
        return $this->belongsToThrough('App\Conference', ['App\Theme', 'App\Paper']);
    }

    public function scopeOfConference($query, $conference)
    {
        $query->whereHas('conference', function ($query) use ($conference)
        {
            $query->where('conferences.id', $conference->id );

        });
    }
}
