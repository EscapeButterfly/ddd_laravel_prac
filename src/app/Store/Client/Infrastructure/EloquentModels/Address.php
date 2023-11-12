<?php

namespace App\Store\Client\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasUuids;

    protected $table = 'addresses';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'client_uuid',
        'street',
        'city',
        'state',
        'country',
        'postal_code'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
