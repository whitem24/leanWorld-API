<?php

namespace App\Models;

Use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title','description','type_certificate_id','order','certificateable_id', 'certificateable_type'  
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
    public function certificateable()
    {
        return $this->morphTo();
    }
    public function templates()
    {
        return $this->morphToMany(Template::class, 'templateable');
    }
    public function type_certificate()
    {
        return $this->belongsTo(Type_certificate::class);
    }
}
