<?php

namespace App\Models;

Use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description', 'description_en', 'description_es', 'order', 'parent_id', 'menu_id'       
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

public function roles()
{
    return $this->belongsToMany('App\Models\Role','roles_has_permissions')->withTimestamps();
}
public function menu()
{
        return $this->belongsTo(Menu::class);
}

public function permissions()
{
    return $this->hasMany(Permission::class, 'parent_id');
}

// recursive relationship
public function childItems()
{
    return $this->hasMany(Permission::class, 'parent_id')->with('permissions');
}

    
}
