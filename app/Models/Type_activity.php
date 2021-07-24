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
        'activity_id','activiteable_id','activiteable_type'        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    
    public function activiteable()
    {
        return $this->morphTo();
    }

    
}
