<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_questionnaire extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'description',        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function type_activities()
    {
        return $this->morphMany(type_activity::class, 'activiteable');
    }
    
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
