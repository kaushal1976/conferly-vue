<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'size',
        'url',
        'type',
        'ext',
        'lastModified',
        'sizeText',
        'videoThumbnail',
        'imageColor',
        'dimensions'
    ];
    
}
