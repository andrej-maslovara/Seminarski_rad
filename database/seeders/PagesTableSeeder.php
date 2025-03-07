<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $viewsDirectory = resource_path('views');
        $viewFiles = collect(\File::allFiles($viewsDirectory))->map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        });

        foreach ($viewFiles as $view) {
            DB::table('pages')->insert([
                'title' => $view,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
