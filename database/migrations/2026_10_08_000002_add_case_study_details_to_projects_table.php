<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * NOTE: Sample case study details provided for portfolio demonstration.
     * Replace sample data with verified client results prior to production deployment.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('client')->nullable()->after('category');
            $table->text('problem')->nullable()->after('description');
            $table->text('solution')->nullable()->after('problem');
            $table->text('result')->nullable()->after('solution');
            $table->text('technologies')->nullable()->after('result');
            $table->string('live_url')->nullable()->after('technologies');
        });

        // Seed / Update projects with detailed sample case study content
        $projectsData = [
            [
                'title' => 'Orbit Dashboard',
                'slug' => 'orbit-dashboard',
                'description' => 'Real-time analytics dashboard that turns shipment data into clear, actionable reports.',
                'category' => 'Web Application',
                'year' => '2024',
                'client' => 'Confidential (Logistics SaaS Startup)',
                'problem' => 'The team tracked deliveries across five separate spreadsheets, causing delayed updates and frequent reporting errors.',
                'solution' => 'Built a single-page web app with automated sync, interactive charts, and role-based access control.',
                'result' => 'Reduced daily reporting time by 75% and gave stakeholders instant visibility into fleet performance.',
                'technologies' => 'React, Tailwind CSS, Laravel REST API, Redis, Chart.js',
                'image_class' => 'card-1',
                'image_path' => 'projects/orbit-dashboard.jpg',
                'is_tall' => 1,
                'is_wide' => 0,
                'order' => 1,
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Puls Finance',
                'slug' => 'puls-finance',
                'description' => 'Cross-platform personal finance app with AI spending insights.',
                'category' => 'Mobile App',
                'year' => '2023',
                'client' => 'Puls Technologies Inc.',
                'problem' => 'Users struggled to categorize expenses and track budget goals across multiple bank accounts.',
                'solution' => 'Engineered an intuitive mobile app featuring automated transaction tagging, smart budgets, and predictive cash-flow forecasting.',
                'result' => 'Achieved a 4.8-star app store rating and over 50,000 active monthly users within 6 months.',
                'technologies' => 'Flutter, Firebase, Node.js Microservices, Plaid API',
                'image_class' => 'card-2',
                'image_path' => 'projects/puls-finance.jpg',
                'is_tall' => 0,
                'is_wide' => 0,
                'order' => 2,
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Vanta Studio',
                'slug' => 'vanta-studio',
                'description' => 'Identity system and marketing site for a creative production house.',
                'category' => 'Brand & Web',
                'year' => '2023',
                'client' => 'Vanta Studio LLC',
                'problem' => "The client's existing website was slow, non-responsive, and failed to reflect their high-end cinematic portfolio.",
                'solution' => 'Redesigned the brand identity and developed a headless web app with fluid motion animations and optimized video playback.',
                'result' => 'Increased visitor engagement time by 120% and tripled lead conversion rates from prospective agency partners.',
                'technologies' => 'Next.js, Framer Motion, Tailwind CSS, Sanity CMS',
                'image_class' => 'card-3',
                'image_path' => 'projects/vanta-studio.jpg',
                'is_tall' => 0,
                'is_wide' => 0,
                'order' => 3,
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Nexus AI Architecture',
                'slug' => 'nexus-ai-architecture',
                'description' => 'Highly scalable microservices architecture enabling massive scale AI inferencing workflows.',
                'category' => 'Enterprise Cloud',
                'year' => '2024',
                'client' => 'Nexus Corp',
                'problem' => 'Legacy backend infrastructure throttled throughput during peak AI workloads, causing high latency and system crashes.',
                'solution' => 'Architected an auto-scaling, event-driven cloud framework with containerized model serving pipelines.',
                'result' => 'Cut inferencing latency by 60% while reducing cloud infrastructure overhead costs by 40%.',
                'technologies' => 'Python, FastAPI, Docker, Kubernetes, AWS EKS, Ray',
                'image_class' => 'card-4',
                'image_path' => 'projects/nexus-ai-architecture.jpg',
                'is_tall' => 0,
                'is_wide' => 1,
                'order' => 4,
                'is_featured' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($projectsData as $data) {
            DB::table('projects')->updateOrInsert(
                ['slug' => $data['slug']],
                $data
            );
        }
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['client', 'problem', 'solution', 'result', 'technologies', 'live_url']);
        });
    }
};
