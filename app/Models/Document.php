<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Document extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title','path','type_document_id','order','documentable_id','documentable_type'        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }
    public function type_document()
    {
        return $this->belongsTo(Type_document::class);
    }
    
}
