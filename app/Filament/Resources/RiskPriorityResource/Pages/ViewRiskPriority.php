<?php

namespace App\Filament\Resources\RiskPriorityResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\RiskPriorityResource;

class ViewRiskPriority extends ViewRecord
{
    protected static string $resource = RiskPriorityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
