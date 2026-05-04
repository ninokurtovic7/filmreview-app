<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film; 

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $query = Film::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $films = $query->latest()->get();

        return view('films.index', compact('films'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('films.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated=$request->validate([
            'title'=>'required|string|max:255',
            'year'=>'required|integer',
            'director'=>'required|string|max:255',
            'description'=>'required|string',
            'poster'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'genre'=>'required|string|max:255'
        ]);
        if ($request->hasFile('poster')) {
        $validated['poster'] = $request->file('poster')->store('posters', 'public');
    }
        Film::create($validated);
        return redirect()->route('films.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        $film->load('reviews.user');

        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'director' => 'required|string|max:255',
            'description' => 'required|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'genre' => 'required|string|max:255'
        ]);
        
       if ($request->hasFile('poster')) {
        $validated['poster'] = $request->file('poster')->store('posters', 'public');
    }
        $film->update($validated);

        return redirect()->route('films.show', $film);
    }

    /**
     * Za brisanje filma iz baze
     */
    public function destroy(Film $film)
    {
        $film->delete();

        return redirect()->route('films.index');
    }
}
