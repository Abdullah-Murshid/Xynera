<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Services
        $services = [
            [
                'number' => '01',
                'title' => 'Web Development',
                'description' => 'Next-generation web applications built with React and Edge-first architectures. Blazing speed meets liquid interactivity.',
                'icon' => 'terminal',
                'tags' => 'React · Next.js · Edge',
                'home_order' => 1,
            ],
            [
                'number' => '02',
                'title' => 'Custom Software',
                'description' => 'Enterprise-grade systems designed to automate complex workflows and scale your operational efficiency.',
                'icon' => 'layers',
                'tags' => 'Enterprise · API · Automation',
                'home_order' => 2,
            ],
            [
                'number' => '03',
                'title' => 'UI/UX Design',
                'description' => 'High-fidelity interfaces focused on user-centric motion and expressive minimalism. Design that feels like hardware.',
                'icon' => 'architecture',
                'tags' => 'Figma · Motion · Systems',
                'home_order' => 3,
            ],
            [
                'number' => '04',
                'title' => 'Mobile Apps',
                'description' => 'Native-feel cross-platform experiences that live seamlessly in your pocket. Built for iOS and Android.',
                'icon' => 'smartphone',
                'tags' => 'iOS · Android · Cross-platform',
                'home_order' => 4,
            ],
            [
                'number' => '05',
                'title' => 'SEO Strategy',
                'description' => 'Data-driven search engine optimization to place your premium services in front of the right audience.',
                'icon' => 'insights',
                'tags' => 'Analytics · Content · Growth',
                'home_order' => 5,
            ],
            [
                'number' => '06',
                'title' => 'Consultation',
                'description' => 'Strategic technical advisory to help you navigate the landscape of modern digital infrastructure.',
                'icon' => 'psychology',
                'tags' => 'Strategy · Technical · Growth',
                'home_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }

        // Projects
        $projects = [
            [
                'title' => 'Orbit Dashboard',
                'category' => 'Web Application',
                'year' => '2024',
                'description' => 'A real-time SaaS analytics platform with edge-deployed data pipelines and fluid micro-interactions.',
                'image_class' => 'card-1',
                'is_tall' => true,
                'order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Puls Finance',
                'category' => 'Mobile App',
                'year' => '2023',
                'description' => 'Cross-platform personal finance app with AI spending insights.',
                'image_class' => 'card-2',
                'is_tall' => false,
                'order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Vanta Studio',
                'category' => 'Brand & Web',
                'year' => '2023',
                'description' => 'Identity system and marketing site for a creative production house.',
                'image_class' => 'card-3',
                'is_tall' => false,
                'order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'Nexus AI Architecture',
                'category' => 'Enterprise Cloud',
                'year' => '2024',
                'description' => 'Highly scalable microservices architecture enabling massive scale AI inferencing workflows.',
                'image_class' => 'card-4',
                'is_tall' => false,
                'is_wide' => true,
                'order' => 4,
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            \App\Models\Project::create($project);
        }

        // Testimonials
        $testimonials = [
            [
                'author_name' => 'Amir Khan',
                'author_role' => 'CEO, Orbit Technologies',
                'quote' => 'Xynera redefined what we thought was possible for our platform. The speed of delivery and quality of the final product was extraordinary.',
                'stars' => 5,
                'author_initials' => 'AK',
                'avatar_class' => 'av-a',
            ],
            [
                'author_name' => 'Sarah Reynolds',
                'author_role' => 'Product Lead, Puls Finance',
                'quote' => 'The design sensibility is unmatched. Our users immediately noticed the difference — engagement is up 40% since the redesign.',
                'stars' => 5,
                'author_initials' => 'SR',
                'avatar_class' => 'av-b',
            ],
            [
                'author_name' => 'Marcus Johansson',
                'author_role' => 'Founder, Vanta Studio',
                'quote' => "From strategy to execution, Xynera is a true partner. They brought ideas we hadn't even considered and executed them flawlessly.",
                'stars' => 5,
                'author_initials' => 'MJ',
                'avatar_class' => 'av-c',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            \App\Models\Testimonial::create($testimonial);
        }

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@xynera.com',
        ]);
    }
}
