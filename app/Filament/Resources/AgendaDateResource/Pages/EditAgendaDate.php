<?php

namespace App\Filament\Resources\AgendaDateResource\Pages;

use App\Filament\Resources\AgendaDateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgendaDate extends EditRecord
{
    protected static string $resource = AgendaDateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
