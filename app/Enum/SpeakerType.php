<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum SpeakerType: string implements HasLabel
{
    case NORMAL = 'Normal';

    case SPECIAL = 'Special Guest';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public static function toArray(): array
    {
        return array_column(SpeakerType::cases(), 'value');
    }
}
