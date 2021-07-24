<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title','content','order','contenteable_id','contenteable_type'        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function contenteable()
    {
        return $this->morphTo();
    }
    
}
