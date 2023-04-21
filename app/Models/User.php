<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\Translation\t;

class User extends Authenticatable
{
    use HasFactory, Notifiable;





    protected $fillable = [
        'fname',
        'lname',
        'role',
        'phone',
        'gender',
        'username',
        'country_code',
        'email',
        'password',
        'email_code',
        'phone_code',
        'profile',
        'coa',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fullName()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function profile_image()
    {
        return url('SSGC_logo.png');
    }

}
