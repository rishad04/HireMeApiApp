<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminAsUser = new User();
        $adminAsUser->name = 'Admin';
        $adminAsUser->email = 'admin@hireme.com';
        $adminAsUser->password = '123456';
        $adminAsUser->role_id = Role::where('slug', 'admin')->value('id'); // admin
        $adminAsUser->save();

        $recruiterAsUser = new User();
        $recruiterAsUser->name = 'Mr. Recruiter';
        $recruiterAsUser->email = 'recruiter@hireme.com';
        $recruiterAsUser->password = '123456';
        $recruiterAsUser->role_id = Role::where('slug', 'recruiter')->value('id'); // recruiter
        $recruiterAsUser->save();

        $jobseekerAsUser = new User();
        $jobseekerAsUser->name = 'Job Seeker';
        $jobseekerAsUser->email = 'jobseeker@hireme.com';
        $jobseekerAsUser->password = '123456';
        $jobseekerAsUser->role_id = Role::where('slug', 'job-seeker')->value('id'); // admin
        $jobseekerAsUser->save();
    }
}
