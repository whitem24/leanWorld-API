<?php

namespace App\Models;


use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
Use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    public function profile(){

        return $this->hasOne(Profile::class);

    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','roles_has_users')->withTimestamps();
    }

    public function scopeUpdateSession($query,$user_id)
    {
        // Fetch the user.
        return $query->with(['roles.permissions.menu' => function($queryI) {
            $queryI->orderBy('order', 'ASC');
        },])->where('id', $user_id);
    }

}
