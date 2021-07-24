<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Live_session extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'link','description','type_live_session_id','order','chapter_id','schedule'       
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function type_live_session()
    {
        return $this->belongsTo(Type_live_session::class);
    }
    
}
