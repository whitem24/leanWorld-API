<?php

namespace App\Models;

Use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lw_users_course_modality extends Model
{
    use HasFactory;
    //use SoftDeletes;
    

    protected $fillable = [
        'username','user_id','course_id','payment_modality_id'   
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
