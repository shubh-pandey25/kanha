<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'category_id' => 1, // Sofas
                'name'        => 'Velvet 3-Seater Sofa',
                'description' => 'Luxurious velvet upholstery with solid wood frame.',
                'price'       => 49999.00,
                'image'       => '/images/products/sofa1.jpg',
            ],
            [
                'category_id' => 2, // Chairs
                'name'        => 'Dining Chair Set (4 pcs)',
                'description' => 'Ergonomic chairs in solid oak with cushioned seats.',
                'price'       => 15999.00,
                'image'       => '/images/products/chairs1.jpg',
            ],
            [
                'category_id' => 3, // Tables
                'name'        => 'Oak Coffee Table',
                'description' => 'Classic mid-century coffee table in solid oak.',
                'price'       => 12999.00,
                'image'       => '/images/products/table1.jpg',
            ],
            [
                'category_id' => 4, // Beds
                'name'        => 'King Size Bed Frame',
                'description' => 'Sturdy metal frame with wooden headboard.',
                'price'       => 25999.00,
                'image'       => '/images/products/bed1.jpg',
            ],
            // add more as needed...
        ];

        foreach ($items as $data) {
            Product::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}