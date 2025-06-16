<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'strMeal' => $this->faker->words(2, true),
        'strCategory' => $this->faker->randomElement(['Pasta', 'Dessert', 'Seafood', 'Chicken']),
        'strArea' => $this->faker->randomElement(['Italian', 'Mexican', 'American', 'Chinese']),
        'strInstructions' => $this->faker->paragraphs(2, true),
        'strMealThumb' => 'https://placehold.co/600x400',
        'strTags' => implode(',', $this->faker->words(3)),
        'strYoutube' => 'https://www.youtube.com/watch?v=' . $this->faker->bothify('???###'),
        'ingredients' => $this->generateRandomArray(['Salt', 'Pepper', 'Tomato', 'Chicken', 'Pasta', 'Egg', 'Cheese']),
        'measures' => $this->generateRandomArray(['1 tsp', '2 cups', '100g', '1/2 tbsp', '3 pieces','lorem']),
        'strSource' => $this->faker->url(),
    ];
}

private function generateRandomArray(array $pool): array
{
    return Arr::random($pool, rand(3, 6));
}
}
