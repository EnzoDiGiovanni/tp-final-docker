<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = [
            [
                'name'        => 'Pasta Carbonara',
                'description' => 'Classic Italian pasta dish with eggs and cured pork.',
                'ingredients' => 'Spaghetti, eggs, pecorino romano, guanciale, black pepper',
                'duration'    => 20,
            ],
            [
                'name'        => 'Caesar Salad',
                'description' => 'Crispy romaine lettuce with Caesar dressing and croutons.',
                'ingredients' => 'Romaine lettuce, croutons, parmesan, Caesar dressing, lemon',
                'duration'    => 10,
            ],
            [
                'name'        => 'Chocolate Lava Cake',
                'description' => 'Warm chocolate cake with a molten center.',
                'ingredients' => 'Dark chocolate, butter, eggs, sugar, flour',
                'duration'    => 25,
            ],
            [
                'name'        => 'Guacamole',
                'description' => 'Fresh avocado dip with lime and cilantro.',
                'ingredients' => 'Avocados, lime juice, cilantro, red onion, jalapeño, salt',
                'duration'    => 10,
            ],
            [
                'name'        => 'Chicken Stir-Fry',
                'description' => 'Quick and easy Asian-style chicken with vegetables.',
                'ingredients' => 'Chicken breast, soy sauce, garlic, ginger, bell peppers, broccoli, sesame oil',
                'duration'    => 15,
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create($recipe);
        }
    }
}
