<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type_activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = [
        'title','description'       
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
    protected $table = "type_activities";

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }  
    
}
