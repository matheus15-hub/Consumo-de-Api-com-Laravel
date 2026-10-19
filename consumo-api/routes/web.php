
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

Route::get('/livros', [LivroController::class, 'index'])
    ->name('livros.index');
