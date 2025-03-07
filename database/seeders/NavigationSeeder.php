<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NavigationSeeder extends Seeder
{
    public function run()
    {
        $navigationItems = Navigation::navigationItems();

        // Use $defaultItems to seed your database
        foreach ($navigationItems as $item) {
            Navigation::create($item);
        }
    }
}
