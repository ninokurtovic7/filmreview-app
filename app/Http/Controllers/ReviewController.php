<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\models\Film;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request, Film $film)
{
    $validated = $request->validate([
        'score' => 'required|integer|between:1,10',
        'comment' => 'nullable|string',
    ]);
 // User moze samo 1 review film, nema duplikata
    if ($film->reviews()->where('user_id', auth()->id())->exists()) {
        return back()->with('error', 'You have already reviewed this film.');
    }

    $film->reviews()->create([
        'score' => $validated['score'],
        'comment' => $validated['comment'] ?? null,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('films.show', $film);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Funkcija za brisanje reviewa, review moze brisati samo korisnik koji je 
     * napisao review ili admin stranice
     */
    public function destroy(Review $review)
    {
    if ($review->user_id !== auth()->id() &&  !auth()->user()->is_admin ) {
        abort(403);
    }

    $film = $review->film;
    $review->delete();

    return redirect()->route('films.show', $film);
    }
}
