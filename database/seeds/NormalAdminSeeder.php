<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Models\Admin\Admin;
use App\Models\Admin\Permission;

class NormalAdminSeeder extends Seeder
{
    public function run()
    {
        $normal_admin = config('sensorization.seeds.normal_admin');
        $user = User::where('email', $normal_admin['email_address'])->count();

        if(!$user) {
            $user = new User;
            $user->name = $normal_admin['name'];
            $user->email = $normal_admin['email_address'];
            $user->password = bcrypt($normal_admin['password']);
            $user->save();

            $admin = new Admin;
            $admin->user_id = $user->id;
            $admin->type = "admin";
            $admin->save();

            foreach ($normal_admin['roles'] as $role_id) {
                $permission = new Permission;
                $permission->concessionaire_id = $admin->user_id;
                $permission->role_id = $role_id;
                $permission->save();
            }
        }
    }
}

