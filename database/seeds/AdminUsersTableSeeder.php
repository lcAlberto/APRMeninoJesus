<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoot();
        $this->createAdmin();
        $this->createTreasurer();
    }

    private function createRoot()
    {
        $root = User::firstOrNew([
            'email' => 'root@email.com'
        ]);
        $permissions = Permission::pluck('guard_name', 'id')->all();
        //'name', 'email', 'password', 'organization_id'

        $root->fill([
            'id' => 1,
            'name' => 'Root',
            'email' => 'root@email.com',
            'password' => Hash::make('root123'),
            'email_verified_at' => now()->toDateString(),
            'img_profile' => 'default.jpg',
            'organization_id' => 1,
        ]);

        $root->save();

        if (!$root->hasRole(\App\Enums\UserRolesEnum::ROOT)) {
            $root->assignRole(\App\Enums\UserRolesEnum::ROOT);
        }
    }

    private function createAdmin()
    {
        $admin = User::firstOrNew([
            'email' => 'admin@email.com'
        ]);

        $admin->fill([
            'id' => 2,
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now()->toDateString(),
            'img_profile' => 'default.jpg',
            'organization_id' => 1,
        ]);

        $admin->save();

        if (!$admin->hasRole(\App\Enums\UserRolesEnum::ADMIN)) {
            $admin->assignRole(\App\Enums\UserRolesEnum::ADMIN);
        }
    }

    private function createTreasurer()
    {
        $client = User::firstOrNew([
            'email' => 'treasurer@email.com'
        ]);

        $client->fill([
            'id' => 3,
            'name' => 'Treasurer',
            'email' => 'treasurer@email.com',
            'password' => Hash::make('treasurer123'),
            'email_verified_at' => now()->toDateString(),
            'img_profile' => 'default.jpg',
            'organization_id' => 1,
        ]);

        $client->save();

        if (!$client->hasRole(\App\Enums\UserRolesEnum::TREASURER)) {
            $client->assignRole(\App\Enums\UserRolesEnum::TREASURER);
        }
    }
}
