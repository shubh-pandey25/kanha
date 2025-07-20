<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $names = ['Sofas', 'Chairs', 'Tables', 'Beds', 'Storage'];

        foreach ($names as $name) {
            Category::updateOrCreate(['name' => $name]);
        }
    }
}