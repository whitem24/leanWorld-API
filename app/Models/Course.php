<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title','description','slug','cover','price','video','type_id'
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];


    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorieable');
    }
    
    public function discounts()
    {
        return $this->morphToMany(Discount::class, 'discountable');
    
    }
    public function type_course()
    {
        return $this->belongsTo(Type_course::class);
    }
    
    public function roles_has_users()
    {
        return $this->belongsToMany(Role_has_user::class, 'user_role_courses','course_id','user_role_id');
    }
    
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    
    
}
