<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TypeUsers extends Model
{
    // use HasFactory;

    //declare table
    public $table = 'type_users';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //one to many
    public function detail_users()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\ManagementAccess\DetailUsers', 'type_users_id');
    }
}
