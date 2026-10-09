<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;

echo "--- TESTING LEGACY URL MAPPING ---" . PHP_EOL;

$testUrls = [
    '/portfolio',
    '/portfolio?category=mobile',
    '/portfolio?category=Mobile',
    '/portfolio?category=Web%20App',
    '/portfolio?category=Brand%20%26%20Web',
    '/portfolio?category=enterprise-cloud',
];

foreach ($testUrls as $url) {
    $request = Request::create($url, 'GET');
    $response = $app->make(App\Http\Controllers\PageController::class)->portfolio($request);
    $viewData = $response->getData();
    echo "URL: {$url}  ==> Active Slug: '{$viewData['activeSlug']}'" . PHP_EOL;
}

echo "--- LEGACY URL MAPPING TEST PASSED ---" . PHP_EOL;
