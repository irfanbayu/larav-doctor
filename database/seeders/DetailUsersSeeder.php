<?php

namespace Database\Seeders;

use App\Models\ManagementAccess\DetailUsers;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_user = [
            [
                'users_id'        => 1,
                'type_users_id'   => 1,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'gender'         => NULL,
                'created_at'     => '2022-04-22 00:00:00',
                'updated_at'     => '2022-04-22 00:00:00',
            ],
        ];

        DetailUsers::insert($detail_user);
    }
}
