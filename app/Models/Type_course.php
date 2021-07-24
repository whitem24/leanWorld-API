<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type_course extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'description',        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
