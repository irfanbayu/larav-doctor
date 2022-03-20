<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ConfigPayments extends Model
{
    // use HasFactory;

    //declare table
    public $table = 'config_payments';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'fee',
        'vat',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
