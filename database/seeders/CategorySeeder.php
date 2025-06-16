<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'idCategory' => '1',
                'strCategory' => 'Chicken',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/chicken.png',
                'strCategoryDescription' => 'Delicious chicken dishes from all around the world.',
            ],
            [
                'idCategory' => '2',
                'strCategory' => 'Italian',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/italian.png',
                'strCategoryDescription' => 'Classic Italian recipes including pasta, pizza, and more.',
            ],
            [
                'idCategory' => '3',
                'strCategory' => 'Chinese',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/chinese.png',
                'strCategoryDescription' => 'Traditional and modern Chinese dishes.',
            ],
            [
                'idCategory' => '4',
                'strCategory' => 'Pasta',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/pasta.png',
                'strCategoryDescription' => 'Variety of pasta dishes from Italy and beyond.',
            ],
            [
                'idCategory' => '5',
                'strCategory' => 'Pizza',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/pizza.png',
                'strCategoryDescription' => 'Tasty and cheesy pizzas from different styles.',
            ],
            [
                'idCategory' => '6',
                'strCategory' => 'Seafood',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/seafood.png',
                'strCategoryDescription' => 'Fresh and savory seafood meals.',
            ],
            [
                'idCategory' => '7',
                'strCategory' => 'Vegetarian',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/vegetarian.png',
                'strCategoryDescription' => 'Healthy and delicious vegetarian dishes.',
            ],
            [
                'idCategory' => '8',
                'strCategory' => 'Dessert',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/dessert.png',
                'strCategoryDescription' => 'Sweet treats and dessert recipes.',
            ],
            [
                'idCategory' => '9',
                'strCategory' => 'Beef',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/beef.png',
                'strCategoryDescription' => 'Juicy and flavorful beef dishes.',
            ],
            [
                'idCategory' => '10',
                'strCategory' => 'Breakfast',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/breakfast.png',
                'strCategoryDescription' => 'Start your day with these delicious breakfasts.',
            ],
            [
                'idCategory' => '11',
                'strCategory' => 'Soup',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/soup.png',
                'strCategoryDescription' => 'Warm and comforting soups for every taste.',
            ],
            [
                'idCategory' => '12',
                'strCategory' => 'Salad',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/salad.png',
                'strCategoryDescription' => 'Fresh and healthy salad options.',
            ],
            [
                'idCategory' => '13',
                'strCategory' => 'Mexican',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/mexican.png',
                'strCategoryDescription' => 'Spicy and flavorful Mexican cuisine.',
            ],
            [
                'idCategory' => '14',
                'strCategory' => 'Indian',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/indian.png',
                'strCategoryDescription' => 'Rich and aromatic Indian dishes.',
            ],
            [
                'idCategory' => '15',
                'strCategory' => 'Vegan',
                'strCategoryThumb' => 'https://www.themealdb.com/images/category/vegan.png',
                'strCategoryDescription' => 'Plant-based and delicious vegan recipes.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['idCategory' => $category['idCategory']],
                $category
            );
        }
    }
}
