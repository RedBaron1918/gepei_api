<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'strMeal',
        'strCategory',
        'strArea',
        'strInstructions',
        'strMealThumb',
        'strTags',
        'strYoutube',
        'ingredients',
        'measures',
        'strSource',
    ];

    protected $casts = [
        'ingredients' => 'array',
        'measures' => 'array',
    ];
}
