<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Web Development',
                'description' => 'Professional web development services using modern technologies like Laravel, React, and Vue.js. We create responsive and scalable web applications.',
                'status' => true,
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Native and cross-platform mobile application development for iOS and Android. Building user-friendly mobile solutions.',
                'status' => true,
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Creative and user-centered design services. We design beautiful interfaces that provide excellent user experience.',
                'status' => true,
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'Comprehensive digital marketing solutions including SEO, social media marketing, and content marketing strategies.',
                'status' => true,
            ],
            [
                'name' => 'Cloud Solutions',
                'description' => 'Cloud infrastructure setup and management services using AWS, Azure, and Google Cloud Platform.',
                'status' => false,
            ],
            [
                'name' => 'Consulting Services',
                'description' => 'Expert technology consulting to help businesses make informed decisions about their digital transformation journey.',
                'status' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
