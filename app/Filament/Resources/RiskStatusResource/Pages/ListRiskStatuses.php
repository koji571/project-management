<?php

namespace App\Filament\Resources\RiskStatusResource\Pages;

use App\Filament\Resources\RiskStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRiskStatuses extends ListRecords
{
    protected static string $resource = RiskStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
