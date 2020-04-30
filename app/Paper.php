<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    protected $fillable = [
        'title',
        'reference'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function authors ()
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }

    public function scopeOfAuthor($query, $user)
    {
        $query->whereHas('authors', function ($query) use ($user)
        {
            $query->where('user_id', $user->id );
        });
    }
    public function conference()
    {
        return $this->belongsToThrough('App\Conference', ['App\Theme']);
    }

    public function scopeOfConference($query, $conference)
    {
        $query->whereHas('conference', function ($query) use ($conference)
        {
            $query->where('conferences.id', $conference->id );
        });
    }
    public function paperAbstracts()
    {
        return $this->hasMany(PaperAbstract::class);
    }

    public function paperFullPapers()
    {
        return $this->hasMany(PaperFullPaper::class);

    }

    public function paperCameraReadyPapers()
    {
        return $this->hasMany(PaperCameraReadyPaper::class);
    }

}
