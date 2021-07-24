<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Chapter extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
        'description', 'course_id'       
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function certificates()
    {
        return $this->morphMany(Certificate::class, 'certificateable');
    }
    public function contents()
    {
        return $this->morphMany(Content::class, 'contenteable');
    }
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
    public function live_sessions()
    {
        return $this->hasMany(Live_session::class);
    }
    public function multimedia()
    {
        return $this->morphMany(Multimedia::class, 'multimediable');
    }
    public function questionnaires()
    {
        return $this->morphMany(Questionnaire::class, 'questionnaireable');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
