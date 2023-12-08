<?php

namespace App\Store\Order\Infrastructure\EloquentModels;

use App\Store\Catalog\Infrastructure\EloquentModels\Book;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $book_uuid
 */
class OrderItem extends Model
{
    use HasUuids;

    protected $table = 'order_items';
    protected $primaryKey = 'uuid';
    protected $fillable = [
        'order_uuid',
        'book_uuid',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_uuid', 'uuid');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_uuid', 'uuid');
    }
}
