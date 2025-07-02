<?php

namespace App\Http\Controllers;

use id;
use App\Models\Meal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::all();
        return response()->json([
            'meals' => $meals
        ]);
    }

    // Get user's own meals
    public function userMeals(Request $request)
    {
        $meals = Meal::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

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

        // Add user_id to validated data
        $validated['user_id'] = Auth::id();

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

    public function update(Request $request, Meal $meal)
    {
        // Check if user owns this meal
        if ($meal->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

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
            // Delete old image if exists
            if ($meal->strMealThumb) {
                $imagePath = str_replace('/storage/', '', $meal->strMealThumb);
                Storage::disk('public')->delete($imagePath);
            }
            $validated['strMealThumb'] = $this->uploadImage($request->file('strMealThumb'));
        }

        $meal->update($validated);

        return response()->json([
            'status' => 'success',
            'data' => $meal,
        ]);
    }

    public function destroy(Meal $meal)
    {
        // Check if user owns this meal
        if ($meal->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

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
}
