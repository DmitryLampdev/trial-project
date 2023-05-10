<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Plank\Metable\Metable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Metable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'current_tenant_id'
    ];
    protected $guarded = [];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $roles = [
        'Member',
        'Admin',
        'Owner'
    ];

    /**
     * @return string
     */
    public function getUserRole(): string
    {
        return $this->roles[array_rand($this->roles)];
    }

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class);
    }
}
