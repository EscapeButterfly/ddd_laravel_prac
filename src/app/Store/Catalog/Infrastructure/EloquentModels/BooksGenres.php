<?php

namespace App\Store\Catalog\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BooksGenres extends Pivot
{
    use HasUuids;

    protected $table      = 'book_genre';
    protected $primaryKey = 'uuid';
}
