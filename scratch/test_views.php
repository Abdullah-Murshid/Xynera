<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Project;

echo "--- TESTING PORTFOLIO PAGE ---" . PHP_EOL;
$projects = Project::all();
$portfolioHtml = view('pages.portfolio', compact('projects'))->render();
echo "Portfolio HTML length: " . strlen($portfolioHtml) . " bytes." . PHP_EOL;

echo "--- TESTING CASE STUDY PAGES ---" . PHP_EOL;
foreach ($projects as $project) {
    $html = view('pages.portfolio-show', ['project' => $project, 'relatedProjects' => Project::where('id', '!=', $project->id)->take(2)->get()])->render();
    echo "Case Study [{$project->title}] (slug: {$project->slug}): " . strlen($html) . " bytes rendered cleanly." . PHP_EOL;
}

echo "--- ALL VIEWS RENDERED SUCCESSFULLY ---" . PHP_EOL;
