<?php

namespace App\Store\Client\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Client extends Model
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

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($client) {
            $client->password = Hash::make($client->password);
        });

        static::updated(function ($client) {
            if ($client->isDirty('password')) {
                $client->password = Hash::make($client->password);
            }
        });
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'client_uuid', 'uuid');
    }


}
