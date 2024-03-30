<?php

namespace App\Filament\Resources\RiskStatusResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\RiskStatusResource;

class ViewRiskStatus extends ViewRecord
{
    protected static string $resource = RiskStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
