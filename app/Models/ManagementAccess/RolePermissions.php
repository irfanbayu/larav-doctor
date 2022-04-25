<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RolePermissions extends Model
{
    // use HasFactory;
    use SoftDeletes;

     //declare table
    public $table = 'role_permissions';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'permissions_id',
        'roles_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //one to many
    public function permissions()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo('App\Models\ManagementAccess\Permissions', 'permissions_id','id');
    }

     public function roles()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo('App\Models\ManagementAccess\Roles', 'roles_id', 'id');
    }
}
