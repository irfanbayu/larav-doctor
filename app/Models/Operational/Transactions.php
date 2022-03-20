<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transactions extends Model
{
    // use HasFactory;

     //declare table
    public $table = 'transactions';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'appointments_id',
        'fee_doctor',
        'fee_specialist',
        'fee_hospital',
        'subtotal',
        'vat',
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //one to many
    public function appointments()
    {
        // 3 parameter (path model, field foreign key)
        return $this->belongsTo('App\Models\Operational\Appointments', 'appointments_id','id');
    }
}
