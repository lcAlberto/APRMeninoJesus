<?php

use App\Enums\UserRolesEnum;
use App\Support\PermissionsHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $profiles = config('profile-permissions');

        $rootPermissions = Permission::all();
        $rootPermissions->pluck('name');
        $adminPermissions = [
            // organizations
            // ...
            // users
            'users index',
            'users view',
            'users create',
            'users update',
            'users delete',
            // patrimonies
            'patrimonies index',
            'patrimonies view',
            'patrimonies create',
            'patrimonies update',
            'patrimonies delete',
            // partners
            'partners index',
            'partners view',
            'partners create',
            'partners update',
            'partners delete',
            // managements
            'managements index',
            'managements view',
            'managements create',
            'managements update',
            'managements delete',
            // borrowings
            'borrowings index',
            'borrowings view',
            'borrowings create',
            'borrowings update',
            'borrowings delete',
        ];
        $treasurerPermissions = [
            // cash_books
            'cash_books index',
            'cash_books view',
            'cash_books create',
            'cash_books update',
            'cash_books delete',
        ];
        $clientPermissions = [
            // borrowings
            'borrowings index',
            'borrowings view',
            'borrowings create',
            'borrowings update',
            'borrowings delete',
        ];

        foreach ($profiles as $profile => $permissions) {
            $rolePermissions = PermissionsHelper::getFlattenPermissions($permissions);
            $role = Role::create([
                'name' => $profile,
                'guard_name' => 'web',
            ]);
            if ($profile == UserRolesEnum::ROOT)
                $role->givePermissionTo($rootPermissions);
            if ($profile == UserRolesEnum::ADMIN)
                $role->givePermissionTo($adminPermissions);
            if ($profile == UserRolesEnum::TREASURER)
                $role->givePermissionTo($treasurerPermissions);
            if ($profile == UserRolesEnum::PARTNER)
                $role->givePermissionTo($clientPermissions);
        }
    }
}
