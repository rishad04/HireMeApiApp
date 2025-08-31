<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jobs')->insert([
            // Job 1: Full-Stack Developer
            [
                'title' => 'Full-Stack Developer',
                'type' => 'Full-time',
                'location' => 'Remote',
                'company_id' => 1,
                'created_by_admin_id' => 1,
                'description' => 'We are seeking a passionate Full-Stack Developer to join our dynamic team. You will be responsible for building and maintaining web applications, working with both front-end (Vue.js, React) and back-end (Laravel, Node.js) technologies. The ideal candidate has strong problem-solving skills and a collaborative spirit.',
                'short_description' => 'Develop and maintain web applications using modern full-stack technologies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Job 2: Senior UX/UI Designer
            [
                'title' => 'Senior UX/UI Designer',
                'type' => 'Full-time',
                'location' => 'New York, NY',
                'company_id' => 2,
                'created_by_admin_id' => 1,
                'description' => 'We are looking for a creative and experienced Senior UX/UI Designer to lead our design efforts. You will be responsible for creating user-centric designs, conducting user research, and collaborating with our product and engineering teams to deliver exceptional user experiences.',
                'short_description' => 'Lead the design process for our digital products, focusing on user experience and interface.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Job 3: Junior Data Analyst
            [
                'title' => 'Junior Data Analyst',
                'type' => 'Part-time',
                'location' => 'San Francisco, CA',
                'company_id' => 3,
                'created_by_admin_id' => 2,
                'description' => 'A great opportunity for a Junior Data Analyst to join a fast-growing tech company. You will assist in collecting, cleaning, and analyzing data to provide insights that drive business decisions. Strong skills in SQL and data visualization are a plus.',
                'short_description' => 'Assist with data analysis and reporting to support business intelligence.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Job 4: Project Manager
            [
                'title' => 'Project Manager',
                'type' => 'Contract',
                'location' => 'London, UK',
                'company_id' => 1,
                'created_by_admin_id' => 2,
                'description' => 'We need a detail-oriented Project Manager to oversee multiple software development projects. You will manage project timelines, budgets, and resources, ensuring projects are completed on time and within scope. Experience with Agile methodologies is required.',
                'short_description' => 'Manage and deliver software projects on time and within budget.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Job 5: Quality Assurance Tester
            [
                'title' => 'Quality Assurance Tester',
                'type' => 'Internship',
                'location' => 'Remote',
                'company_id' => 4,
                'created_by_admin_id' => 3,
                'description' => 'An excellent internship for an aspiring QA Tester. You will work alongside our development team to identify and report software bugs, create test cases, and ensure product quality. This is a great chance to gain hands-on experience in a professional environment.',
                'short_description' => 'Test software applications to ensure quality and bug-free performance.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
