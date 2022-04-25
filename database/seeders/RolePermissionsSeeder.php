<?php

namespace Database\Seeders;

use App\Models\ManagementAccess\Permissions;
use App\Models\ManagementAccess\Roles;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // for super admin
        $admin_permissions = Permissions::all();
        Roles::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        // get permission simple for admin
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });

        // for admin
        Roles::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
