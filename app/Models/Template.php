<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Template extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'title','description','content','order'    
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function activities()
    {
        return $this->morphedByMany(Activity::class, 'templateable');
    }
    
}
