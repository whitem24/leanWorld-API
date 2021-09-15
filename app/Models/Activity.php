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
        'title','description','type_activity_id'      
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $table = "activities";

    public function type_activity()
    {
        return $this->belongsTo(Type_activity::class);
    }
    public function chapters()
    {
        return $this->belongsToMany(Chapter::class)->withPivot('content', 'order', 'path', 'duration', 'link', 'schedule')/* ->using(Activity_chapter::class) */;
    }
    public function templates()
    {
        return $this->morphToMany(Template::class, 'templateable');
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
