<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiskResource\Pages;
use App\Filament\Resources\RiskResource\RelationManagers;
use App\Models\Risk;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RiskResource extends Resource
{
    protected static ?string $model = Risk::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation';

    protected static ?int $navigationSort = 5;

    protected static function getNavigationLabel(): string
    {
        return __('Risks');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project')
                    ->label(__('Project'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('owner.name')
                    ->label(__('Project owner'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('risk')
                    ->label(__('Project risk'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('risk.status')
                    ->label(__('Risk status'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRisks::route('/'),
            'create' => Pages\CreateRisk::route('/create'),
            'view' => Pages\ViewRisk::route('/{record}'),
            'edit' => Pages\EditRisk::route('/{record}/edit'),
        ];
    }
}
