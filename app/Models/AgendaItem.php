<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class AgendaItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'agenda_id',
        'time',
        'title',
        'description',
    ];

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class);
    }

    public function dates(): HasManyThrough
    {
        return $this->hasManyThrough(AgendaDate::class, Agenda::class, 'id', 'agenda_id');
    }
}
