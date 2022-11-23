<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Illuminate\Database\Eloquent\SoftDeletes;

class Payment_method extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description', 'description_en', 'fee'        
    ];
    protected $dates= [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function payment_transactions()
    {
        return $this->hasMany(Payment_transaction::class);

    }

}
 