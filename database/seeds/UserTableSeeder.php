<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $role_admin = Role::where('name', 'admin')->first();
        $role_subscriber = Role::where('name', 'subscriber')->first();

        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'lpkapil@gmail.com';
        $admin->password = bcrypt('admin123');
        $admin->status = true;
        $admin->save();
        $admin->roles()->attach($role_admin);

        $subscriber = new User();
        $subscriber->name = 'Subscriber User';
        $subscriber->email = 'lpkapil@mailinator.com';
        $subscriber->password = bcrypt('admin123');
        $subscriber->status = true;
        $subscriber->save();
        $subscriber->roles()->attach($role_subscriber);
    }

}
