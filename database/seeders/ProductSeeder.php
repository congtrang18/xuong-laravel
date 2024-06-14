<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVarian;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        ProductVarian::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();
        Tag::factory(15)->create();
        // S, M, L, XL, XXL
        foreach (['S', 'M', 'L', 'XL', 'XXL'] as $item) {
            ProductSize::query()->create([
                'name' => $item
            ]);
        }
        foreach (['#0000FF', '#FF00FF', '#33CCFF', '#FF0033', '#00EE00'] as $item) {
            ProductColor::query()->create([
                'name' => $item
            ]);
        }
        $name = fake()->text(100);
        for ($i = 0; $i < 1000; $i++) {
            Product::query()->create([
                'catelogue_id' => rand(2, 4),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(8) . $i,
                'img_thumbnail' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s004-sk010-1.webp',
                'price_regular' => 600000,
                'price_sale' => 500000,

            ]);
        }
        for ($i = 1; $i < 1001; $i++) {
          
            ProductGallery::insert([
                [
                    'product_id' => $i,
                    'image' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s004-sk010-1.webp',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://canifa.com/img/1000/1500/resize/6/o/6ot24s004-sk010-thumb.webp',
                ],
            ]);
        }
        // product tag
        for ($i = 1; $i < 1001; $i++) {
            DB::table('product_tag')->insert([
                [
                    'product_id' => $i,
                    'tag_id' => rand(1, 8)
                ],
                [
                    'product_id' => $i,
                    'tag_id' => rand(9, 15)
                ],

            ]);
        }
        for ($productID = 1; $productID < 1001; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID < 6; $sizeID++) {
                for ($colorID = 1; $colorID < 6; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quatity' => 100,
                        'image' => 'https://canifa.com/img/1000/1500/resize/6/0/60t24s002-sb001-1-1-u.webp'
                    ];
                }
            }
            DB::table('product_varians')->insert($data);
        }
    }
}
