<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Course_discount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'course_id', 'discount_id'       
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
    

}
