<?php

namespace App\Enum;

enum EventType: string
{
    case NORMAL = 'normal';
    case CONFERENCE = 'conference';

    public static function toArray(): array
    {
        return array_column(EventType::cases(), 'value');
    }
}
