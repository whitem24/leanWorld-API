<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Multimedia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title','description','type_multimedia_id','path','duration','order','multimediable_id', 'multimediable_type'  
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
    public function multimediable()
    {
        return $this->morphTo();
    }
    public function type_multimedia()
    {
        return $this->belongsTo(Type_multimedia::class);
    }
}
