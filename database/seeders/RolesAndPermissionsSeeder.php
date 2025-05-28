<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // إhdo dirlhm route T3hm
        $permissions = [
            'create question',
            'answer question',
            'edit own answer',
            'delete own answer',
            'delete any question',
            'delete any answer',
            'approve user',
            'promote to moderator',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $moderator = Role::firstOrCreate(['name' => 'moderator']);
        $member = Role::firstOrCreate(['name' => 'member']);
        $user = Role::firstOrCreate(['name' => 'user']);

        
        $admin->givePermissionTo(Permission::all());

        $moderator->givePermissionTo([
            'create question',
            'answer question',
            'delete any question',
            'delete any answer',
        ]);
         
        $member->givePermissionTo([
            'create question',
            'answer question',
            'edit own answer',
            'delete own answer',
        ]);

        // user ...
    }
}
