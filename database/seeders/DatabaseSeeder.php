<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Exception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Perdoe esse codigo bagunçado, é só pra testar mesmo
        try {
            Tag::factory(20)->create();
        } catch (Exception $e) {
        }
        try {
            for ($i = 0; $i < 100; $i++) {
                $products = Product::factory()->create();
                $products->tags()->sync(random_int(1, 15));
            }
        } catch (Exception $e) {
        }
    }
}
