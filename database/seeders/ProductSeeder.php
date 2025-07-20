<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // wipe out old products
        Product::truncate();

        $items = [
            // Sofas (category_id = 1)
            [
                'category_id' => 1,
                'name'        => 'Velvet 3-Seater Sofa',
                'description' => 'Luxurious velvet upholstery with solid wood frame.',
                'price'       => 49999.00,
                'image'       => 'https://source.unsplash.com/600x400/?sofa,furniture',
            ],
            [
                'category_id' => 1,
                'name'        => 'Linen 2-Seater Sofa',
                'description' => 'Breathable linen fabric on a sturdy pine frame.',
                'price'       => 35999.00,
                'image'       => 'https://source.unsplash.com/600x400/?linen,sofa',
            ],
            [
                'category_id' => 1,
                'name'        => 'Chesterfield Leather Sofa',
                'description' => 'Classic tufted leather design with rolled arms.',
                'price'       => 79999.00,
                'image'       => 'https://source.unsplash.com/600x400/?leather,sofa',
            ],

            // Chairs (category_id = 2)
            [
                'category_id' => 2,
                'name'        => 'Ergonomic Office Chair',
                'description' => 'Adjustable lumbar support in breathable mesh.',
                'price'       => 10999.00,
                'image'       => 'https://source.unsplash.com/600x400/?office,chair',
            ],
            [
                'category_id' => 2,
                'name'        => 'Rocking Chair',
                'description' => 'Comfortable oak rocking chair with padded seat.',
                'price'       => 8999.00,
                'image'       => 'https://source.unsplash.com/600x400/?rocking,chair',
            ],
            [
                'category_id' => 2,
                'name'        => 'Dining Chair Set (4 pcs)',
                'description' => 'Solid oak chairs with cushioned seats.',
                'price'       => 15999.00,
                'image'       => 'https://source.unsplash.com/600x400/?dining,chair',
            ],

            // Tables (category_id = 3)
            [
                'category_id' => 3,
                'name'        => 'Oak Coffee Table',
                'description' => 'Mid-century modern solid oak coffee table.',
                'price'       => 12999.00,
                'image'       => 'https://source.unsplash.com/600x400/?coffee,table',
            ],
            [
                'category_id' => 3,
                'name'        => 'Glass Top Dining Table',
                'description' => 'Tempered glass surface with metal legs.',
                'price'       => 22999.00,
                'image'       => 'https://source.unsplash.com/600x400/?glass,table',
            ],
            [
                'category_id' => 3,
                'name'        => 'Pine Wood Side Table',
                'description' => 'Rustic pine side table with lower shelf.',
                'price'       => 4999.00,
                'image'       => 'https://source.unsplash.com/600x400/?side,table',
            ],

            // Beds (category_id = 4)
            [
                'category_id' => 4,
                'name'        => 'King Size Bed Frame',
                'description' => 'Metal frame with wooden headboard.',
                'price'       => 25999.00,
                'image'       => 'https://source.unsplash.com/600x400/?bedframe',
            ],
            [
                'category_id' => 4,
                'name'        => 'Upholstered Queen Bed',
                'description' => 'Tufted fabric headboard with slatted base.',
                'price'       => 31999.00,
                'image'       => 'https://source.unsplash.com/600x400/?upholstered,bed',
            ],
            [
                'category_id' => 4,
                'name'        => 'Metal Bunk Bed',
                'description' => 'Space-saving twin-over-twin metal bunk bed.',
                'price'       => 18999.00,
                'image'       => 'https://source.unsplash.com/600x400/?bunk,bed',
            ],

            // Storage (category_id = 5)
            [
                'category_id' => 5,
                'name'        => '5-Drawer Chest',
                'description' => 'Maple wood chest with smooth-glide drawers.',
                'price'       => 14999.00,
                'image'       => 'https://source.unsplash.com/600x400/?chest,drawers',
            ],
            [
                'category_id' => 5,
                'name'        => 'Wall-Mounted Shelves (3 pcs)',
                'description' => 'Floating shelves in walnut finish.',
                'price'       => 7999.00,
                'image'       => 'https://source.unsplash.com/600x400/?wall,shelves',
            ],
            [
                'category_id' => 5,
                'name'        => 'Wardrobe with Mirror',
                'description' => 'Sliding-door wardrobe with built-in mirror.',
                'price'       => 25999.00,
                'image'       => 'https://source.unsplash.com/600x400/?wardrobe',
            ],
        ];

        foreach ($items as $data) {
            Product::create($data);
        }
    }
}