<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title','description',        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    public function type_activities()
    {
        return $this->hasMany(Type_activity::class);
    }
}
