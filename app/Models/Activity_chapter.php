<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Activity_chapter extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content','path','duration','order','link','schedule','chapter_id','activity_id'      
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $table = "activity_chapter";
}
