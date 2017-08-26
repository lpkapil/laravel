<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'A Admin User';
        $role_manager->status = true;
        $role_manager->save();

        $role_employee = new Role();
        $role_employee->name = 'subscriber';
        $role_employee->description = 'A Subscriber User';
        $role_employee->status = true;
        $role_employee->save();
    }

}
