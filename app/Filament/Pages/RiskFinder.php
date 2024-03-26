<?php

namespace App\Filament\Pages;

use App\Models\Project;
use Filament\Pages\Page;
use App\Models\TicketStatus;
use Filament\Resources\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;

class RiskFinder extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static string $view = 'filament.pages.risk-finder';

    protected static ?int $navigationSort = 6;

    public ?array $data = [];
    public $project_id;
    public $message = ''; // Default value for the message

    protected static function getNavigationGroup(): ?string
    {
        return __('Management');
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()
                ->schema([
                    Grid::make()
                        ->schema([
                            Select::make('project_id')
                                ->label(__('Project'))
                                ->searchable()
                                ->reactive()
                                ->afterStateUpdated(function ($set, $state) {
                                    $project = Project::find($state);
                                    if ($project) {
                                        //$this->message = "Project Selected: " . $project->name;
                                        $prompt = (string)view('risk-finder.query',[
                                            'project_name' => $project->name,
                                            'project_description' => strip_tags($project->description),
                                            'project_tickets' => $project->tickets,
                                        ]);
                                        $set('message', $prompt);
                                    }
                                })
                                ->options(fn() => Project::where('owner_id', auth()->user()->id)
                                    ->orWhereHas('users', function ($query) {
                                        return $query->where('users.id', auth()->user()->id);
                                    })->pluck('name', 'id')->toArray()
                                )
                                ->default(fn() => request()->get('project'))
                                ->required(),
                        ]),
                ]),
            Textarea::make('message')
                ->label('Message ChatGPT')
                ->required(),
        ];
    }

    public function create(): void
    {
        $message = $this->form->getState()['message'];
        $this->data['message'] = '';
    }

}
