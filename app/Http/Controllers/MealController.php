<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{

public function index()
{
    $meals = Meal::all();

    return response()->json([
        'meals' => $meals
    ]);
}

public function search(Request $request)
{
    $query = $request->query('q');

    $meals = Meal::when($query, function ($q) use ($query) {
        $q->where('strMeal', 'like', "%{$query}%")
          ->orWhere('strCategory', 'like', "%{$query}%")
          ->orWhere('strArea', 'like', "%{$query}%");
    })->get();

    return response()->json(['meals' => $meals]);
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'strMeal' => 'required|string',
            'strCategory' => 'nullable|string',
            'strArea' => 'nullable|string',
            'strInstructions' => 'nullable|string',
            'strMealThumb' => 'nullable|url',
            'strTags' => 'nullable|string',
            'strYoutube' => 'nullable|url',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'nullable|string',
            'measures' => 'nullable|array',
            'measures.*' => 'nullable|string',
            'strSource' => 'nullable|url',
        ]);

        $meal = Meal::create($validated);

        return response()->json([
            'status' => 'success',
            'data' => $meal,
        ], 201);
    }

    public function show(Meal $meal)
    {
        return response()->json($meal);
    }
}
