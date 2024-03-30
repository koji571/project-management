<?php

namespace App\Filament\Resources\RiskStatusResource\Pages;

use App\Filament\Resources\RiskStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiskStatus extends EditRecord
{
    protected static string $resource = RiskStatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
