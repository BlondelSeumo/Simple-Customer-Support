<?php

namespace App\Models;

use App\Enums\ProductProvider;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'provider',
        'name',
        'code',
    ];

    protected $casts = [
        'provider' => ProductProvider::class,
        'is_disabled' => 'boolean',
        'disabled_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
    }

    public function agents(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Agent::class)->withPivot('is_manager');
    }

    public function managers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->agents()->wherePivot('is_manager', true);
    }

    public function assignees(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->agents()->wherePivot('is_manager', false);
    }

    public function tickets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    protected function isDisabled(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['disabled_at'] !== null,
        );
    }

    public function isFromEnvato(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['provider'] === ProductProvider::ENVATO->name,
        );
    }
}
