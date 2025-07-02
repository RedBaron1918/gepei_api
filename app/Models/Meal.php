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
        'user_id',
    ];

    protected $casts = [
        'ingredients' => 'array',
        'measures' => 'array',
        'strTags' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
