<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            /*ROOT's FARM*/
            [
                'cnpj' => '11.932.125/0001-76',
                'name' => 'Associação Menino Jesus',
                'postal_code' => '85012040',
                'state_id' => 41,
                'city_id' => 4109401,
            ],
        ]);
    }
}
