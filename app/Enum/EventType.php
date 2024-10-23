<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum EventType: string implements HasLabel
{
    case NORMAL = 'Normal';
    case CONFERENCE = 'Conference';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public static function toArray(): array
    {
        return array_column(EventType::cases(), 'value');
    }
}
