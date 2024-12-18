<?php

// database/seeders/IngredientSeeder.php
namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan Factory untuk membuat 10 data Ingredient
        Ingredient::factory()->count(10)->create();
    }
}