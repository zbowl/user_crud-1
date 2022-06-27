<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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
        'username',
        'email',
        'password', //not normal for real world use
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * I do not agree with this method and know that under normal circumstances
     * we would not want to expose a password. I have a couple ideas to change this.
     *     Do we need the password to be visible? Technically no, because we cant reveal the password value due to the way it is stored in the database.
     *     So what is the point in unhiding a password? Simply put, the current way I have been able to implement the $users and $newUsers values. Binding these between Alpine and Livewire to seemlessly update and store the records.
     * I would prefer to make this hidden again and perhaps set a "default" password value. Maybe I take more advantage of Policies or implement an Auth.
     *
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //'password', //not normal for real world use
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
     * The setting up a simple filterable scope that will allow us to only return users with a given email domain.
     *
     *
     * @param $query
     * @param $emailDomain
     * @return mixed
     */
    public function scopeOfEmailDomain($query, $emailDomain): mixed
    {
        return $query->where('email','like','%' . $emailDomain);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public function password(): User
    {
        return $this->makeVisibleIf(Auth::user()->is_admin,'password');
    }

}
