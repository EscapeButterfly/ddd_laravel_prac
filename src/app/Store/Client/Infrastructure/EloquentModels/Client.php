<?php

namespace App\Store\Client\Infrastructure\EloquentModels;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Client extends User implements JWTSubject
{
    use HasUuids;

    protected $table = 'clients';

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone_number',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'client_uuid', 'uuid');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
