<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'url',
        'size',
        'type',
        'ext',
        'lastModified',
        'sizeText',
        'videoThumbnail',
        'imageColor',
        'dimensions'
    ];
    
    public function getUrlAttribute()
    {
        return $this->name;

    }
}

