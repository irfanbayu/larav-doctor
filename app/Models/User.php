<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    // use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    // many to many --- //
    public function roles()
    {
        return $this->belongsToMany('App\Models\ManagementAccess\Roles');
    }

    //one to many
     public function appointments()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Operational\Appointments', 'user_id'); //users_id
    }

    public function detail_user()
    {
        //2 parameter (path model, field foreign key)
        return $this->hasOne('App\Models\ManagementAccess\DetailUsers', 'user_id');
    }

    // Alias for backward compatibility
    public function detail_users()
    {
        return $this->detail_user();
    }

    public function roles_user()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\ManagementAccess\RoleUsers', 'user_id');
    }
}
