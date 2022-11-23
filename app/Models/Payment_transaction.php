<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Illuminate\Database\Eloquent\SoftDeletes;

class Payment_transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_role_id', 'course_id', 'payment_method_id', 'amount'        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $table = "payment_transactions";

    public function payment_method()
    {
        return $this->belongsTo(Payment_method::class);
    }

    public function role_has_user()
    {
        return $this->belongsTo(Role_has_user::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
 