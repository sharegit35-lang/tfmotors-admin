<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model; // ហៅយក Class របស់ MongoDB Model ត្រឹមត្រូវ
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Authenticatable;

    protected $connection = 'mongodb';
    protected $table = 'users'; // ជំនាន់ v5.0 ប្រើ $table ជំនួស $collection

    protected $fillable = [
        'name',
        'email',
        'password',
        'department',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}