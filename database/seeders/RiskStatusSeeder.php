<?php

namespace Database\Seeders;

use App\Models\RiskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiskStatusSeeder extends Seeder
{
    private array $data = [
        [
            'name' => 'To Resolve',
            'color' => '#cecece',
            'is_default' => true,
            'order' => 1
        ],
        [
            'name' => 'Resolving',
            'color' => '#ff7f00',
            'is_default' => false,
            'order' => 2
        ],
        [
            'name' => 'Resolved',
            'color' => '#008000',
            'is_default' => false,
            'order' => 3
        ],
        [
            'name' => 'Archived',
            'color' => '#ff0000',
            'is_default' => false,
            'order' => 4
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $item) {
            RiskStatus::firstOrCreate($item);
        }
    }
}
