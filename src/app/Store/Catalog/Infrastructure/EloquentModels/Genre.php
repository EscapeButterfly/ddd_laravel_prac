<?php

namespace App\Store\Catalog\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $table = 'genres';

    protected $fillable = [
        'uuid',
        'genre'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(
            Book::class,
            'book_genre',
            'genre_uuid',
            'book_uuid'
        );
    }
}
