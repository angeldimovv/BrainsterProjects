<?php

namespace App\Models;

use App\Enum\EventStatus;
use Carbon\Carbon;
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

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($event) {
            $agendaDate = Carbon::parse($event->date);
            $event->status = $agendaDate->isFuture() ? EventStatus::UPCOMING : EventStatus::FINISHED;
        });

        static::updating(function ($event) {
            $agendaDate = Carbon::parse($event->date);
            $event->status = $agendaDate->isFuture() ? EventStatus::UPCOMING : EventStatus::FINISHED;
        });
    }
}
