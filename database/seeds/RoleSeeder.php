<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $admins_roles = config('sensorization.seeds.admins_roles');

        foreach ($admins_roles as $container) {
            Role::firstOrCreate([
                'name' => $container['name'],
                'description' => $container['description']
            ]);
        }   
    }
}
