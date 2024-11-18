<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'genre',
        'release_date',
        'thumbnail',
        'thumbnail_modal',
        'video_url',
    ];
}
