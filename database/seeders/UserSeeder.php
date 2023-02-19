<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@chelino.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $rol = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'admin']);
        $rol->syncPermissions($permission);
        //le asiga el rol al usuario creado
    }
}
