<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'affiliation'
    ];

    public function papers() {
        return $this->belongsToMany(Paper::class)->withTimestamps();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
