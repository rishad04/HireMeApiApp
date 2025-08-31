<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [

            [
                'name' => 'Admin',
                'slug' => 'admin',
                'permissions' => $this->adminPermissions(),
            ],
            [
                'name' => 'Recruiter',
                'slug' => 'recruiter',
                'permissions' => $this->recruiterPermissions(),
            ],
            [
                'name' => 'Job Seeker', // user
                'slug' => 'job-seeker',
                'permissions' => $this->userPermissions(),
            ],
        ];

        foreach ($roles as $roleData) {
            $role = new Role();
            $role->name = $roleData['name'];
            $role->slug = $roleData['slug'];
            $role->permissions = $roleData['permissions'];
            $role->save();
        }
    }
    private function adminPermissions()
    {
        return [

            // user = job seekers
            'admin_test',

            'user_view',
            'user_create',
            'user_edit',
            'user_delete',

            'company_view',
            'company_create',
            'company_edit',
            'company_delete',

            'recruiter_view',
            'recruiter_create',
            'recruiter_edit',
            'recruiter_delete',

            'job_view',
            'job_create',
            'job_edit',
            'job_delete',

            'application_view',
            'application_create',
            'application_edit',
            'application_delete',

            'payment_view',
            'payment_create',
            'payment_edit',
            'payment_delete',
        ];
    }
    private function recruiterPermissions()
    {
        return [

            'company_view',
            'company_create',
            'company_edit',

            'recruiter_view',
            'recruiter_edit',

            'job_view',
            'job_create',
            'job_edit',
            'job_delete',

            'application_view',

            'payment_view',
        ];
    }
    private function userPermissions()
    {
        return [

            'user_test',

            'user_view',
            'user_create',
            'user_edit',

            'company_view',


            'recruiter_view',

            'job_view',

            'application_view',
            'application_create',

            'initiate_payment'
        ];
    }
}
