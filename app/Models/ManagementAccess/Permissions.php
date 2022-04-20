<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permissions extends Model
{
    // use HasFactory;
    use SoftDeletes;

     //declare table
    public $table = 'permissions';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //declare fillable
    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     // many to many
    public function roles()
    {
        return $this->belongsToMany('App\Models\ManagementAccess\Roles');
    }

    //one to many
    public function role_permissions()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\ManagementAccess\RolePermissions', 'permissions_id');
    }
}
