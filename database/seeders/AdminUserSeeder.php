<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            [
                'email' => 'admin@localhost.test',
            ],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('ChangeMe@12345'),
                'active' => true,
            ]
        );

        $role = Role::where(
            'name',
            'Super Admin'
        )->firstOrFail();

        $user->syncRoles([
            $role
        ]);
    }
}