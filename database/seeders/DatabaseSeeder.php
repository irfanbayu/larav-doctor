<?php

namespace Database\Seeders;

use App\Models\ManagementAccess\DetailUsers;
use App\Models\ManagementAccess\RolePermissions;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeUsersSeeder::class,
            ConsultationsSeeder::class,
            ConfigPaymentsSeeder::class,
            SpecialistsSeeder::class,
            UsersSeeder::class,
            DetailUsersSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            RolePermissionsSeeder::class,
            RoleUsersSeeder::class,
        ]);
    }
}
