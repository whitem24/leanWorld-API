<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Templateable extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'template_id','templateable_id','templateable_type'    
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
