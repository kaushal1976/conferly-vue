<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [
        'title',
        'description',
        'venue',
        'tag_line',
        'subject_area',
        'start_date',
        'end_date',
        'image'
    ];

    protected $casts = [
        'start_date'=>'datetime:Y-m-d',
        'end_date'=>'datetime:Y-m-d',
    ];

    public function themes() {
        return $this->hasMany(Theme::class);
    }

}
