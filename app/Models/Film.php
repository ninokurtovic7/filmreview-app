<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
    'title',
    'year',
    'director',
    'description',
    'poster',
    'genre'
];
public function reviews()
{
    return $this->hasMany(Review::class);
}
}
