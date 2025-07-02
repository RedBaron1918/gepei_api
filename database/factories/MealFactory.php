<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    private $cookingVideos = array(
        'https://www.youtube.com/watch?v=P6W8kwmwcno',
        'https://www.youtube.com/watch?v=fNMtHl2VSA4',
        'https://www.youtube.com/watch?v=RaLzxZryEoA',
        'https://www.youtube.com/watch?v=NTBRThwL-2c',
        'https://www.youtube.com/watch?v=j__wz7NtNgM',
        'https://www.youtube.com/watch?v=xdwLxfJBOWE',
        'https://www.youtube.com/watch?v=yN001XyoSas',
        'https://www.youtube.com/watch?v=S-TmmjEN-V0'
    );

    private $ingredientsList = ['Salt', 'Pepper', 'Tomato', 'Chicken', 'Pasta', 'Egg', 'Cheese'];
    private $measures = ['1 tsp', '2 cups', '100g', '1/2 tbsp', '3 pieces', 'lorem'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'strMeal' => $this->faker->words(2, true),
            'strCategory' => $this->faker->randomElement(['Pasta', 'Dessert', 'Seafood', 'Chicken']),
            'strArea' => $this->faker->randomElement(['Italian', 'Mexican', 'American', 'Chinese']),
            'strInstructions' => $this->faker->paragraphs(2, true),
            'strMealThumb' => Storage::url('meals/default.jpg'),
            'strTags' => $this->faker->words(3),
            'strYoutube' => $this->generateRandomArray($this->cookingVideos),
            'ingredients' => $this->generateRandomArray($this->ingredientsList, count($this->ingredientsList)),
            'measures' => $this->generateRandomArray($this->measures, count($this->measures)),
            'strSource' => $this->faker->url(),
        ];
    }

    private function generateRandomArray(array $pool, ?int $max = null)
    {
        if ($max != null) {
            return Arr::random($pool, rand(0, $max));
        }
        return Arr::random($pool);
    }
}
