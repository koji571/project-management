<?php

namespace App\Filament\Resources\RiskPriorityResource\Pages;

use App\Filament\Resources\RiskPriorityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiskPriority extends EditRecord
{
    protected static string $resource = RiskPriorityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
