<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $edit_position = Permission::create(['name' => 'edit position']);
        $delete_position = Permission::create(['name' => 'delete position']);
        $create_position = Permission::create(['name' => 'create position']);
        $view_position = Permission::create(['name' => 'view position']);

        $edit_skill = Permission::create(['name' => 'edit skill']);
        $delete_skill = Permission::create(['name' => 'delete skill']);
        $create_skill = Permission::create(['name' => 'create skill']);
        $view_skill = Permission::create(['name' => 'view skill']);

        $edit_language = Permission::create(['name' => 'edit language']);
        $delete_language = Permission::create(['name' => 'delete language']);
        $create_language = Permission::create(['name' => 'create language']);
        $view_language = Permission::create(['name' => 'view language']);

        $edit_resume = Permission::create(['name' => 'edit resume']);
        $delete_resume = Permission::create(['name' => 'delete resume']);
        $create_resume = Permission::create(['name' => 'create resume']);
        $view_resume = Permission::create(['name' => 'view resume']);

        $edit_vacancy = Permission::create(['name' => 'edit vacancy']);
        $delete_vacancy = Permission::create(['name' => 'delete vacancy']);
        $create_vacancy = Permission::create(['name' => 'create vacancy']);
        $view_vacancy = Permission::create(['name' => 'view vacancy']);

        // create roles and assign created permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            $edit_position,
            $delete_position,
            $create_position,
            $view_position,
            $edit_skill,
            $delete_skill,
            $create_skill,
            $view_skill,
            $edit_language,
            $delete_language,
            $create_language,
            $view_language,
            $delete_resume,
            $view_resume,
            $delete_vacancy,
            $view_vacancy
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            $edit_resume,
            $delete_resume,
            $create_resume,
            $view_resume,
            $view_vacancy,
            $view_position,
            $view_skill,
            $view_language,
        ]);

        $organizationRole = Role::create(['name' => 'organization']);
        $organizationRole->givePermissionTo([
            $edit_vacancy,
            $delete_vacancy,
            $create_vacancy,
            $view_vacancy,
            $view_resume,
            $view_position,
            $view_skill,
            $view_language,
        ]);
    }
}

