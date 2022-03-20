<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Specialists extends Model
{
    // use HasFactory;

    //declare table
    public $table = 'specialists';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'name',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //one to many
    public function doctors()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Operational\Doctors', 'specialists_id');
    }
}
