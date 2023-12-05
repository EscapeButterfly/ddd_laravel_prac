<?php

namespace App\Store\Order\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids;

    protected $table = 'orders';
    protected $primaryKey = 'uuid';
    protected $fillable = [
        'uuid',
        'client_uuid',
        'status',
        'payment_type',
        //TODO
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];


}
