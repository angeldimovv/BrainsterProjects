<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'theme',
        'description',
        'objective',
        'agenda_id',
        'date',
        'location',
        'ticket_price',
        'type',
        'status',
    ];

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
