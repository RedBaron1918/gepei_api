<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idCategory' => 'required|unique:categories',
            'strCategory' => 'required',
            'strCategoryThumb' => 'required|url',
            'strCategoryDescription' => 'nullable|string',
        ]);

        $category = Category::create($validated);
        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->only([
            'strCategory',
            'strCategoryThumb',
            'strCategoryDescription',
        ]));

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
