<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'tesista';
        $role->description = 'Tesista';
        $role->save();

        $role = new Role();
        $role->name = 'titulacion';
        $role->description = 'Titulacion';
        $role->save();

        $role = new Role();
        $role->name = 'sinodal';
        $role->description = 'sinodal';
        $role->save();
    }
}
