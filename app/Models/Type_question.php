<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_question extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'description',        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
