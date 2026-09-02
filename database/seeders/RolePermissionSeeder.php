<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'dashboard.view',

            'results.view',
            'results.create',
            'results.update',
            'results.delete',

            'games.view',
            'games.create',
            'games.update',
            'games.delete',

            'cities.view',
            'cities.create',
            'cities.update',
            'cities.delete',

            'users.view',
            'users.create',
            'users.update',
            'users.delete',

            'roles.view',
            'roles.create',
            'roles.update',
            'roles.delete',

            'permissions.view',
            'permissions.create',
            'permissions.update',
            'permissions.delete',
             'charts.view',
            'charts.create',
            'charts.update',
            'charts.delete',

            'scraper.view',
            'scraper.create',
            'scraper.update',
            'scraper.delete',
            'scraper.run',
            'khaiwals.view',
            'khaiwals.create',
            'khaiwals.update',
            'khaiwals.delete',
            'blogs.view',
            'blogs.create',
            'blogs.update',
            'blogs.delete',
            'blogs.publish',

            'faqs.view',
            'faqs.create',
            'faqs.update',
            'faqs.delete',

            'seo.view',
            'seo.create',
            'seo.update',
            'seo.delete',

            'settings.view',
            'settings.update',

            'scraper.view',
            'scraper.run',

            'activity-logs.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $superAdmin->syncPermissions(
            Permission::all()
        );
    }
}
