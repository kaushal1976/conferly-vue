<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    protected $fillable = [
        'available',
        'max_reviews'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function expertAreas()
    {
        return $this->belongsToMany(ExpertArea::class)->withTimestamps();
    }
    public function paperAbstracts ()
    {
        return $this->belongsToMany(PaperAbstract::class)->using(PaperAbstractReviewer::class)
            ->with('paper' );
    }
    public function paperFullPapers ()
    {
        return $this->belongsToMany(PaperFullPaper::class)->using(PaperFullPaperReviewer::class)
            ->with('paper' );
    }
    public function ofConference(Conference $conference)
    {
        $isReviewer = $this->paperAbstracts()
                ->OfConference($conference)
                ->count()
            +$this->paperFullPapers()
                ->OfConference($conference)
                ->count()
            > 0;
        return $isReviewer;
    }
}
