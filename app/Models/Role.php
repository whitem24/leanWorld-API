<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description',        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
public function users()
{
    return $this->belongsToMany('App\Model\User','roles_has_users')->withTimestamps();
}
public function permissions()
{
    return $this->belongsToMany('App\Models\Permission','roles_has_permissions')->withTimestamps();
}
}

