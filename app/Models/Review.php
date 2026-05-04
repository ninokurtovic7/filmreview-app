<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Film;
use App\Models\User;

class Review extends Model
{
        protected $fillable = [
        'user_id',
        'film_id',
        'score',
        'comment',
        ];

public function film()
{
    return $this->belongsTo(Film::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}