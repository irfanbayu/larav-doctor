<?php

namespace Database\Seeders;

use App\Models\MasterData\ConfigPayments;

use Illuminate\Database\Seeder;
use Illumiminate\Support\Facades\DB;

class ConfigPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create data here
        $config_payments = [
            [
                'fee' => '150000',
                'vat' => '20', // vat is percentage
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        //this array $config_payment will be insert to table config_payments
        ConfigPayments::insert($config_payments);
    }
}
