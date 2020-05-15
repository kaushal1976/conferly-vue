<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [

        'title',
        'description',
    ];
    protected $visible = [
        'id',
        'title',
        'description',
        'papers',
        'themeLeaders',
    ];
    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
    public function papers()
    {
        return $this->hasMany(Paper::class);
    }
    public function scopeOfConference($query, $conferenceId)
    {
        return $query->where('conference_id', $conferenceId);
    }
    public function themeLeaders()
    {
        return $this->hasMany(ThemeLeader::class);
    }

}
