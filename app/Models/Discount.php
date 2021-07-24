<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Discount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description','percent','date_start','date_end'        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
    public function courses()
    {
        return $this->morphedByMany(Course::class, 'discountable');

    }
    public function products()
    {
        return $this->morphedByMany(Product::class, 'discountable');
    }
}
