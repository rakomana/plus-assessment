<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'View Admin Dashboard']);
        Permission::create(['name' => 'Administer Users']);
        
        // create roles and assign created permissions
        
        // this can be done as separate statements
        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());
        
        // or may be done by chaining
        $role = Role::create(['name' => 'Content Manager'])
            ->givePermissionTo(['View Admin Dashboard']);
        
        $role = Role::create(['name' => 'User']);
        $role->givePermissionTo(Permission::all());
    }
}
