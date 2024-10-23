<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'social_media',
        'photo',
    ];

    protected function casts(): array
    {
        return [
            'social_media' => 'array',
        ];
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_speakers');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($event) {
            $event->photo = 'https://ui-avatars.com/api/?background=111111&color=fff&length=1&font-size=0.65&format=svg&name=' . $event->first_name;
        });
    }
}
