<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'strMealThumb' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'strTags' => 'nullable|array',
            'strYoutube' => 'nullable|url',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'nullable|string',
            'measures' => 'nullable|array',
            'measures.*' => 'nullable|string',
            'strSource' => 'nullable|url',
        ]);

        // Handle image upload
        if ($request->hasFile('strMealThumb')) {
            $validated['strMealThumb'] = $this->uploadImage($request->file('strMealThumb'));
        }

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

    /**
     * Upload image and return the file path
     */
    private function uploadImage($file)
    {
        // Generate unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Store in public/meals directory
        $path = $file->storeAs('meals', $filename, 'public');

        // Return the full URL path
        return Storage::url($path);
    }

    /**
     * Delete image file when meal is deleted
     */
    public function destroy(Meal $meal)
    {
        // Delete the image file if it exists
        if ($meal->strMealThumb) {
            $imagePath = str_replace('/storage/', '', $meal->strMealThumb);
            Storage::disk('public')->delete($imagePath);
        }

        $meal->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Meal deleted successfully'
        ]);
    }
}
