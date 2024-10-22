<?php

namespace App\Enum;

enum EventStatus: string
{
    case UPCOMING = 'upcoming';
    case FINISHED = 'finished';

    public static function toArray(): array
    {
        return array_column(EventStatus::cases(), 'value');
    }
}
