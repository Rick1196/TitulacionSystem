<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'tesista')->first();
        $role_user = Role::where('name', 'sinodal')->first();
        $role_admin = Role::where('name', 'titulacion')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'Tesista';
        $user->email = 'tesista@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Sinodal';
        $user->email = 'sinodal@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);


        $user = new User();
        $user->name = 'Jefe';
        $user->email = 'jefe@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
