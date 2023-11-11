<?php

namespace App\Store\Catalog\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasUuids;

    protected $table      = 'authors';
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'birth_date',
        'bio',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(
            Book::class,
            'authors_books',
            'author_uuid',
            'book_uuid'
        );
    }
}
