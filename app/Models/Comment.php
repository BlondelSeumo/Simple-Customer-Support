<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Comment extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'content',
        'is_private',
    ];

    protected $touches = ['commentable'];

    protected $casts = [
        'is_private' => 'boolean',
    ];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

    public function commentator()
    {
        return $this->morphTo('commentator');
    }

    public function commentable()
    {
        return $this->morphTo('commentable');
    }
}
