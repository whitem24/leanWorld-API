<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\User;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_picture',
        'username',
        'first_name',
        'last_name',
        'orginaztion_name',
        'location',
        'email',
        'number',
        'birthday',
    ];

    //One to one relationship with user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
