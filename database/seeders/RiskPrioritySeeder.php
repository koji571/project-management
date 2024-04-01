<?php

namespace Database\Seeders;

use App\Models\RiskPriority;
use Illuminate\Database\Seeder;

class RiskPrioritySeeder extends Seeder
{
    private array $data = [
        [
            'name' => 'Low',
            'color' => '#008000',
            'is_default' => false
        ],
        [
            'name' => 'Normal',
            'color' => '#CECECE',
            'is_default' => true
        ],
        [
            'name' => 'High',
            'color' => '#ff0000',
            'is_default' => false
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
            RiskPriority::firstOrCreate($item);
        }
    }
}
