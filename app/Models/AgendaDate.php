<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgendaDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'agenda_id',
        'date',
    ];

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(AgendaItem::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
