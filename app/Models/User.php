<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject

{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'age',
        'cpf',
        'type',
        'email_verified',
        'email_verification_token',
        'token_forget_password'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'cpf' => $this->cpf,
            'type' => $this->type,
            'email_verified' => $this->email_verified,
            // 'email_verification_token' => $this->email_verification_token,
            // 'token_forget_password' => $this->token_forget_password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'type' => $this->type,
            'id' => $this->id
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        $dateTime = new DateTime($value);
        $dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        return $dateTime->format('d-m-Y, H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        $dateTime = new DateTime($value);
        $dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        return $dateTime->format('d-m-Y, H:i:s');
    }
}
