<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum EventStatus: string implements HasLabel
{
    case UPCOMING = 'Upcoming';
    case FINISHED = 'Finished';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public static function toArray(): array
    {
        return array_column(EventStatus::cases(), 'value');
    }
}
