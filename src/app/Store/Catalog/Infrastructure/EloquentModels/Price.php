<?php

namespace App\Store\Catalog\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasUuids;

    protected $table = 'book_prices';
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'book_uuid',
        'currency',
        'price'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function books(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_uuid');
    }
}
