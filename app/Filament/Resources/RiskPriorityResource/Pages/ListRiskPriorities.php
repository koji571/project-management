<?php

namespace App\Filament\Resources\RiskPriorityResource\Pages;

use App\Filament\Resources\RiskPriorityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRiskPriorities extends ListRecords
{
    protected static string $resource = RiskPriorityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
