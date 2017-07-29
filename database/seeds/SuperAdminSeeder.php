<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Models\Admin\Admin;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $super_admin = config('sensorization.seeds.super_admin');
        $user = User::where('email', $super_admin['email_address'])->count();

        if(!$user) {
            $user = new User;
            $user->name = $super_admin['name'];
            $user->email = $super_admin['email_address'];
            $user->password = bcrypt($super_admin['password']);
            $user->save();

            $admin = new Admin;
            $admin->user_id = $user->id;
            $admin->type = "super_admin";
            $admin->save();
        }
    }
}

