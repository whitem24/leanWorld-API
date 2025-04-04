<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description'
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
