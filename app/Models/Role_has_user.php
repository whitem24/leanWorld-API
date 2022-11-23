<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_has_user extends Model
{
    use HasFactory;
    protected $table = "roles_has_users";
    
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_role_courses','user_role_id','course_id');
    }

    public function payment_transactions()
    {
        return $this->hasMany(Payment_transaction::class);

    }
}
