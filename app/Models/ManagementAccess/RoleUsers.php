<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RoleUsers extends Model
{
    // use HasFactory;

     //declare table
    public $table = 'role_users';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'roles_id',
        'users_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     public function users()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\Users', 'users_id','id');
    }

      public function roles()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo('App\Models\ManagementAccess\Roles', 'roles_id','id');
    }
}
