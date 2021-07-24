<?php

namespace App\Models;

Use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lw_payment_modality extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    protected $fillable = [
        'description','company_percent','instructor_percent', 'affiliate_percent'     
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
