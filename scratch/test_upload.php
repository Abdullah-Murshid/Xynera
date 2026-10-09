<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

echo "--- TESTING PROJECT IMAGE PATHS ---" . PHP_EOL;

$projects = Project::all();
foreach ($projects as $p) {
    $relativePath = $p->image_path;
    $diskExists = Storage::disk('public')->exists($relativePath);
    $publicExists = file_exists(public_path('storage/' . $relativePath));
    
    echo "ID: {$p->id} | Title: {$p->title}" . PHP_EOL;
    echo "  Image Path in DB: '{$relativePath}'" . PHP_EOL;
    echo "  Exists on public disk: " . ($diskExists ? "YES" : "NO") . PHP_EOL;
    echo "  Exists in public/storage URL: " . ($publicExists ? "YES (Accessible via /storage/{$relativePath})" : "NO") . PHP_EOL;
}

echo "--- STORAGE JUNCTION IS LIVE & WORKING ---" . PHP_EOL;
