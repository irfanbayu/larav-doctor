<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Appointments extends Model
{
    // use HasFactory;

    //declare table
    public $table = 'appointments';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'doctors_id',
        'users_id',
        'consultations_id',
        'level',
        'date',
        'time',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //one to many
    public function doctors()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\Operational\Doctors', 'doctors_id','id');
    }

    public function consultations()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Consultations', 'consultations_id','id');
    }

    public function users()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\Users', 'users_id','id');
    }

     //one to one
    public function transactions()
    {
        //2 parameter (path model, field foreign key)
        return $this->hasOne('App\Models\Operational\Transactions', 'appointments_id');
    }

}
