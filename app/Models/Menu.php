<?php

namespace App\Models;

Use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description', 'order', 'icon'      
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
public function permissions()
{
    return $this->hasMany('App\Models\Permission')->withTimestamps();
}

}
