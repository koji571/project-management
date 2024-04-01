<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Risk;
use App\Models\User;
use Filament\Tables;
use App\Models\Project;
use App\Models\RiskStatus;
use Filament\Resources\Table;
use App\Models\RiskPriority;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\RiskResource\Pages;
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
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('project_id')
                                    ->label(__('Project'))
                                    ->searchable()
                                    ->reactive()
                                    ->options(fn() => Project::where('owner_id', auth()->user()->id)
                                        ->orWhereHas('users', function ($query) {
                                            return $query->where('users.id', auth()->user()->id);
                                        })->pluck('name', 'id')->toArray()
                                    )
                            ]),
                        Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label(__('Risk title'))
                                ->required()
                                ->columnSpan(
                                    fn($livewire) => !($livewire instanceof CreateRecord) ? 10 : 12
                                )
                                ->maxLength(255),
                        ]),
                        Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\Select::make('creator_id')
                                ->label(__('Risk Creator'))
                                ->searchable()
                                ->options(fn() => User::all()->pluck('name', 'id')->toArray())
                                ->default(fn() => auth()->user()->id)
                                ->required(),

                            Forms\Components\Select::make('responsible_id')
                                ->label(__('Risk Caretaker'))
                                ->searchable()
                                ->options(fn() => User::all()->pluck('name', 'id')->toArray()),

                        ]),
                        Forms\Components\Grid::make()
                            ->columns(3)
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\Select::make('status_id')
                                            ->label(__('Risk status'))
                                            ->searchable()
                                            ->options(function ($get) {
                                                $project = Project::where('id', $get('project_id'))->first();
                                                if ($project?->status_type === 'custom') {
                                                    return RiskStatus::where('project_id', $project->id)
                                                        ->get()
                                                        ->pluck('name', 'id')
                                                        ->toArray();
                                                } else {
                                                    return RiskStatus::whereNull('project_id')
                                                        ->get()
                                                        ->pluck('name', 'id')
                                                        ->toArray();
                                                }
                                            })
                                            ->default(function ($get) {
                                                $project = Project::where('id', $get('project_id'))->first();
                                                if ($project?->status_type === 'custom') {
                                                    return RiskStatus::where('project_id', $project->id)
                                                        ->where('is_default', true)
                                                        ->first()
                                                        ?->id;
                                                } else {
                                                    return RiskStatus::whereNull('project_id')
                                                        ->where('is_default', true)
                                                        ->first()
                                                        ?->id;
                                                }
                                            })
                                            ->required(),

                                        Forms\Components\Select::make('priority_id')
                                            ->label(__('Risk priority'))
                                            ->searchable()
                                            ->options(fn() => RiskPriority::all()->pluck('name', 'id')->toArray())
                                            ->default(fn() => RiskPriority::where('is_default', true)->first()?->id)
                                            ->required(),
                        ]),
                    Forms\Components\RichEditor::make('content')
                            ->label(__('Risk Details'))
                            ->required()
                            ->columnSpan(2),
                    Forms\Components\Grid::make()
                        ->columnSpan(2)
                        ->columns(12)
                        ->schema([
                            Forms\Components\TextInput::make('estimation')
                                ->label(__('Estimation time (days)'))
                                ->numeric()
                                ->columnSpan(2),
                            ]),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('project.name')
                ->label(__('Project'))
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('name')
                ->label(__('Ticket name'))
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('owner.name')
                ->label(__('Owner'))
                ->sortable()
                ->formatStateUsing(fn($record) => view('components.user-avatar', ['user' => $record->owner]))
                ->searchable(),

            Tables\Columns\TextColumn::make('responsible.name')
                ->label(__('Responsible'))
                ->sortable()
                ->formatStateUsing(fn($record) => view('components.user-avatar', ['user' => $record->responsible]))
                ->searchable(),

            Tables\Columns\TextColumn::make('status.name')
                ->label(__('Status'))
                ->sortable()
                ->formatStateUsing(fn($record) => new HtmlString("
                            <div class=\"flex items-center gap-2 mt-1\">
                                <span class=\"filament-tables-color-column relative flex h-6 w-6 rounded-md\"
                                    style=\"background-color: {$record->status->color}\"></span>
                                <span>{$record->status->name}</span>
                            </div>
                        "))
                ->searchable(),

            Tables\Columns\TextColumn::make('priority.name')
                ->label(__('Priority'))
                ->sortable()
                ->formatStateUsing(fn($record) => new HtmlString("
                            <div class=\"flex items-center gap-2 mt-1\">
                                <span class=\"filament-tables-color-column relative flex h-6 w-6 rounded-md\"
                                    style=\"background-color: {$record->priority->color}\"></span>
                                <span>{$record->priority->name}</span>
                            </div>
                        "))
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label(__('Created at'))
                ->dateTime()
                ->sortable()
                ->searchable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('project_id')
                ->label(__('Project'))
                ->multiple()
                ->options(fn() => Project::where('owner_id', auth()->user()->id)
                    ->orWhereHas('users', function ($query) {
                        return $query->where('users.id', auth()->user()->id);
                    })->pluck('name', 'id')->toArray()),

            Tables\Filters\SelectFilter::make('owner_id')
                ->label(__('Owner'))
                ->multiple()
                ->options(fn() => User::all()->pluck('name', 'id')->toArray()),

            Tables\Filters\SelectFilter::make('responsible_id')
                ->label(__('Responsible'))
                ->multiple()
                ->options(fn() => User::all()->pluck('name', 'id')->toArray()),

            Tables\Filters\SelectFilter::make('status_id')
                ->label(__('Status'))
                ->multiple()
                ->options(fn() => RiskStatus::all()->pluck('name', 'id')->toArray()),

            Tables\Filters\SelectFilter::make('priority_id')
                ->label(__('Priority'))
                ->multiple()
                ->options(fn() => RiskPriority::all()->pluck('name', 'id')->toArray()),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
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
