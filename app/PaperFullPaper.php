<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperFullPaper extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    protected $fillable = [
        'status',
        'outcome',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function fullPaperReviews()
    {
        return $this->hasMany(FullPaperReview::class);
    }

    public function fullPaperFiles()
    {
        return $this->hasMany(FullPaperFile::class);
    }

    public function reviewers()
    {
        return $this->belongsToMany(Reviewer::class)->using(PaperFullPaperReviewer::class);
    }

    public function scopeOfReviewer($query, $user)
    {
        $query->whereHas('reviewers', function ($query) use ($user)
        {
            $query->where('user_id', $user->id );
        });
    }

    public function scopeOfPaper($query, $paper)
    {
        return $query->where('paper_id', $paper->id );
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
