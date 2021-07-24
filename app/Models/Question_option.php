<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_option extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_correct','other_text', 'order'
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
