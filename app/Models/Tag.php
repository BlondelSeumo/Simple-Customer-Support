<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type', 'color', 'description'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function tickets()
    {
        return $this->morphedByMany(Ticket::class, 'taggable');
    }
}
