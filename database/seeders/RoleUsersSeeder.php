<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ManagementAccess\RoleUsers;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::findOrFail(1)->role()->sync(1);
    }
}
