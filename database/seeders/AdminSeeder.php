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
                'name' => 'Admin',
                'email' => 'admin@hireme.com',
                'role_id' => 1,
                'is_recruiter' => 0,
                'password' => '112233',
            ],
            [
                'id' => 2,
                'name' => 'Recruiter',
                'email' => 'recruiter@hireme.com',
                'role_id' => 2,
                'company_id' => 1,
                'is_recruiter' => 1,
                'password' => '112233',
            ],

            [
                'id' => 3,
                'name' => 'Recruiter 2',
                'email' => 'recruiter2@hireme.com',
                'role_id' => 2,
                'is_recruiter' => 1,
                'company_id' => 2,
                'password' => '112233',
            ],
            [
                'id' => 4,
                'name' => 'Recruiter 3',
                'email' => 'recruiter3@hireme.com',
                'role_id' => 2,
                'is_recruiter' => 1,
                'company_id' => 1,
                'password' => '112233',
            ],

        ];

        foreach ($admins as $admin) {

            DB::table('admins')->insert([
                'id' => $admin['id'],
                'name' => $admin['name'],
                'email' => $admin['email'],
                'role_id' => $admin['role_id'],
                'company_id' => $admin['company_id'] ?? null,
                'is_active' => 1,
                'is_recruiter' => $admin['is_recruiter'],
                'password' => Hash::make($admin['password']),
            ]);
        }
    }
}
