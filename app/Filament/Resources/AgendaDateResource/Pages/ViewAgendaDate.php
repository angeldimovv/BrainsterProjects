<?php

namespace App\Filament\Resources\AgendaDateResource\Pages;

use App\Filament\Resources\AgendaDateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAgendaDate extends ViewRecord
{
    protected static string $resource = AgendaDateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
