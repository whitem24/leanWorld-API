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

    /* public function activities()
    {
        return $this->morphMany(Activity::class, 'activitiable');
    } */
    /* public function contents()
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
    } */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function activities()
    {
        return $this->belongsToMany(Activity::class)->wherePivot('deleted_at', NULL)->withPivot('id','content', 'description', 'order', 'path', 'duration', 'link', 'schedule', 'deleted_at')/* ->using(Activity_chapter::class) */;

    }
}
