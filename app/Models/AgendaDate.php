<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaDate extends Model
{
    use HasFactory;

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
