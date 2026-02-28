<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('recipes.index'));

Route::resource('recipes', RecipeController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
