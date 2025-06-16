<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/xxxx_xx_xx_create_meals_table.php
public function up()
{
    Schema::create('meals', function (Blueprint $table) {
        $table->id();
        $table->string('strMeal');
        $table->string('strCategory')->nullable();
        $table->string('strArea')->nullable();
        $table->text('strInstructions')->nullable();
        $table->string('strMealThumb')->nullable();
        $table->string('strTags')->nullable();
        $table->string('strYoutube')->nullable();
        $table->json('ingredients')->nullable();
        $table->json('measures')->nullable();
        $table->string('strSource')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
