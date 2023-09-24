<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // entrer la commande artisan : php artisan db:seed --class=ProductsSeeder
        \App\Models\Products::factory(10)->create();
    }
}
