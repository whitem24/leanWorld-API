<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Type_document extends Model
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
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
