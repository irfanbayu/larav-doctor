<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUsers extends Model
{
    // use HasFactory;

    use SoftDeletes;

    //declare table
    public $table = 'detail_users';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'users_id',
        'type_users_id',
        'contact',
        'address',
        'photo',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     //one to many
    public function type_users()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany)
        return $this->belongsTo('App\Models\MasterData\TypeUsers', 'type_users_id', 'id');
    }

     //one to many
    public function users()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany)
        return $this->belongsTo('App\Models\Users', 'users_id', 'id');
    }


     //one to many
    public function role_users()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany)
        return $this->hasMany('App\Models\ManagementAccess\RoleUsers', 'users_id');
    }
}
