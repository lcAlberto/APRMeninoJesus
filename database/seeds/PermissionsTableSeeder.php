<?php

use Illuminate\Database\Seeder;
use App\Support\PermissionsHelper;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $permissions = config('permissions');
        $permissions = PermissionsHelper::getFlattenPermissions($permissions);
        foreach ($permissions as $permission) {
            $model = Permission::findOrCreate($permission, 'web');
            $model->save();
        }
    }
}
