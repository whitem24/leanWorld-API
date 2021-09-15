<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title','order','questionnaires_id','type_questions_id'      
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
      public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    public function type_question()
    {
        return $this->belongsTo(Type_question::class);
    }
}
