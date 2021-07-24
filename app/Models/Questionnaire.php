<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title','description','order','type_questionnaire_id','questionnaireable_id','questionnaireable_type' 
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function questionnaireable()
    {
        return $this->morphTo();
    }
    public function type_questionnaire()
    {
        return $this->belongsTo(Type_questionnaire::class);
    }
}
