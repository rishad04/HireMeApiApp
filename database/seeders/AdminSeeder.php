<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class AdminSeeder extends Seeder
{
    public function run()
    {


        $admins = [

            [
                'id' => 1,
                'name' => 'Super Admin',
                'email' => 'superadmin@hireme.com',
                'role_id' => 1,
                'password' => '112233',
            ],
            [
                'id' => 2,
                'name' => 'Recruiter',
                'avatar' => 'assets/images/avatar/2.jpg',
                'email' => 'hire@hireme.com',
                'role_id' => 2,
                'password' => '112233',
            ],

            [
                'id' => 3,
                'name' => 'Recruiter 2',
                'avatar' => 'assets/images/avatar/3.jpg',
                'email' => 'hire2@hireme.com',
                'role_id' => 2,
                'password' => '112233',
            ],

        ];

        foreach ($admins as $admin) {

            DB::table('admins')->insert([
                'id' => $admin['id'],
                'name' => $admin['name'],
                'email' => $admin['email'],
                'role_id' => $admin['role_id'],
                'is_active' => 1,
                'password' => Hash::make($admin['password']),
            ]);
        }
    }
}
