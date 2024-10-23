<?php

namespace App\Filament\Resources\CompanyInfoResource\Pages;

use App\Filament\Resources\CompanyInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyInfo extends ViewRecord
{
    protected static string $resource = CompanyInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
