<?php

namespace App\Store\Order\Infrastructure\EloquentModels;

use App\Store\Client\Infrastructure\EloquentModels\Address;
use App\Store\Client\Infrastructure\EloquentModels\Client;
use App\Store\Order\Domain\Model\Enums\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string     $client_uuid
 * @property string     $address_uuid
 * @property string     $status
 * @property Collection $items
 * @property string     $uuid
 */
class Order extends Model
{
    use HasUuids;

    protected $table      = 'orders';
    protected $primaryKey = 'uuid';
    protected $fillable   = [
        'uuid',
        'client_uuid',
        'address_uuid',
        'status',
    ];
    protected $hidden     = [
        'created_at',
        'updated_at'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_uuid', 'uuid');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_uuid', 'uuid');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_uuid', 'uuid');
    }
}
