<?php

namespace App\Models;

use Laravel\Sanctum\NewAccessToken; // Add this line

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function createToken(string $name, array $abilities = ['*']): NewAccessToken
    {
        // Your custom logic for token generation
        // This example adds a custom prefix to the token name
        $name = 'custom-prefix-' . $name;
        
        return $this->tokens()->create([
            'name' => $name,
            'token' => Hash::make(Str::random(40)),
            'abilities' => $abilities,
        ]);
    }

}
