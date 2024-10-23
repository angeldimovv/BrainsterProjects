<?php

namespace App\Filament\Resources\AgendaItemResource\Pages;

use App\Filament\Resources\AgendaItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgendaItems extends ListRecords
{
    protected static string $resource = AgendaItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
