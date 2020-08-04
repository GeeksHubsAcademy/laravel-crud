<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'AK-47',
                'price' => 3500,
                'image_path' => 'https://atlantic-firearms-prod.s3.amazonaws.com/media/detail_product_main/product/arsenal-sam7-sfk-ak47-rifle-gambit-limited-edition.jpg',
                'stock' => 45008,
                'available' => 1,
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'sable pistola final fantasy',
                'price' => 199.00,
                'image_path' => 'https://i.ebayimg.com/images/g/RgoAAOSwOVpXe-f3/s-l400.jpg',
                'stock' => 15,
                'available' => 1,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
