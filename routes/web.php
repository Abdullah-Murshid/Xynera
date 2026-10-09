<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Frontend Routes
Route::middleware(['throttle:global_public'])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
    Route::get('/portfolio/{project:slug}', [PageController::class, 'portfolioShow'])->name('portfolio.show');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit')->middleware('throttle:contact');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [PageController::class, 'terms'])->name('terms');
    Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
});

// Admin Auth
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.submit')->middleware('throttle:login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Protected Routes
Route::middleware(['auth', 'no-cache'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Portfolio
    Route::get('/portfolio', [AdminController::class, 'portfolio'])->name('admin.portfolio');
    Route::post('/portfolio', [AdminController::class, 'storeProject'])->name('admin.portfolio.store');
    Route::put('/portfolio/{id}', [AdminController::class, 'updateProject'])->name('admin.portfolio.update');
    Route::delete('/portfolio/{id}', [AdminController::class, 'deleteProject'])->name('admin.portfolio.delete');

    // Services
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
    Route::post('/services', [AdminController::class, 'storeService'])->name('admin.services.store');
    Route::put('/services/{id}', [AdminController::class, 'updateService'])->name('admin.services.update');
    Route::delete('/services/{id}', [AdminController::class, 'deleteService'])->name('admin.services.delete');

    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('admin.messages.delete');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    // SEO Management
    Route::get('/seo', [App\Http\Controllers\SeoController::class, 'index'])->name('admin.seo');
    Route::post('/seo', [App\Http\Controllers\SeoController::class, 'update'])->name('admin.seo.update');
    Route::delete('/seo/{seoMeta}', [App\Http\Controllers\SeoController::class, 'destroy'])->name('admin.seo.destroy');

    // FAQ Management
    Route::get('/faqs', [App\Http\Controllers\FaqController::class, 'index'])->name('admin.faqs');
    Route::post('/faqs', [App\Http\Controllers\FaqController::class, 'store'])->name('admin.faqs.store');
    Route::put('/faqs/{id}', [App\Http\Controllers\FaqController::class, 'update'])->name('admin.faqs.update');
    Route::delete('/faqs/{id}', [App\Http\Controllers\FaqController::class, 'delete'])->name('admin.faqs.delete');
});
