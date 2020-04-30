<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [

        'title',
        'description',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function papers()
    {
        return $this->hasMany(Paper::class);
    }


    public function scopeOfConference($query, $conference)
    {
        return $query->where('conference_id', $conference->id);
    }

    public function themeLeaders()
    {
        return $this->hasMany(ThemeLeader::class);
    }

}
