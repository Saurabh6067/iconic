<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Sarah Johnson',
                'role' => 'CEO & Founder',
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Michael Chen',
                'role' => 'Lead Developer',
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Emily Rodriguez',
                'role' => 'UI/UX Designer',
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'David Williams',
                'role' => 'Project Manager',
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Jessica Brown',
                'role' => 'Marketing Specialist',
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Robert Taylor',
                'role' => 'Backend Developer',
                'image' => null,
                'status' => false,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }
    }
}
