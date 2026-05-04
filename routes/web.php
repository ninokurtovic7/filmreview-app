<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FilmController;

Route::get('/', function () {
    return redirect()->route('films.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute koje moze pristupiti samo admin
Route::middleware(['auth','admin'])->group(function () {
    Route::get('films/create', [FilmController::class, 'create'])->name('films.create');
    Route::post('films', [FilmController::class, 'store'])->name('films.store');
    Route::get('films/{film}/edit', [FilmController::class, 'edit'])->name('films.edit');
    Route::put('films/{film}', [FilmController::class, 'update'])->name('films.update');
    Route::delete('films/{film}', [FilmController::class, 'destroy'])->name('films.destroy');
});

// Javno dostupne rute
Route::resource('films', FilmController::class)->only([
    'index', 'show'
]);
// Laravel breeze rute
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
    ->middleware('auth')
    ->name('reviews.destroy');

Route::post('/films/{film}/reviews', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

