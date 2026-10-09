<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    public function home(): View
    {
        $services = Service::take(5)->get();
        $projects = Project::where('is_featured', true)->take(3)->get();
        $testimonials = Testimonial::take(3)->get();
        
        return view('pages.home', compact('services', 'projects', 'testimonials'));
    }

    public function services(): View
    {
        $services = Service::all();
        $faqs = Faq::where('is_published', true)->orderBy('order')->get();
        return view('pages.services', compact('services', 'faqs'));
    }

    public function portfolio(Request $request): View
    {
        $rawCategory = $request->query('category');
        $activeSlug = $this->normalizeCategorySlug($rawCategory);

        $projects = Project::orderBy('order', 'asc')->get();

        return view('pages.portfolio', compact('projects', 'activeSlug'));
    }

    /**
     * Map clean URL slugs and legacy query inputs to standard filter slugs.
     */
    private function normalizeCategorySlug(?string $input): string
    {
        if (empty($input)) {
            return 'all';
        }

        $inputLower = strtolower(trim(rawurldecode($input)));

        return match ($inputLower) {
            'web-apps', 'web-app', 'web app', 'web application', 'web apps', 'web' => 'web-apps',
            'mobile', 'mobile app', 'mobile-app', 'mobile apps' => 'mobile',
            'branding', 'brand', 'brand & web', 'brand-web', 'brand and web', 'brand &amp; web' => 'branding',
            'enterprise-cloud', 'enterprise cloud', 'enterprise', 'cloud' => 'enterprise-cloud',
            default => 'all',
        };
    }

    public function portfolioShow(Project $project): View
    {
        $relatedProjects = Project::where('id', '!=', $project->id)->orderBy('order', 'asc')->take(2)->get();
        return view('pages.portfolio-show', compact('project', 'relatedProjects'));
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }

    public function submitContact(ContactRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        // 1. Store in Database
        $message = ContactMessage::create($validated);

        // 2. Send email to agency admin
        try {
            Mail::to(config('mail.from.address', 'admin@xynera.com'))
                ->send(new ContactMail($validated));
        } catch (\Exception $e) {
            Log::error('Mail Error: ' . $e->getMessage());
            // We still proceed as the message is stored in the DB
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Message delivered successfully.',
                'id' => $message->id ?? rand(1000, 9999)
            ]);
        }

        // 3. Notify the user using the new helper
        notify('Your message has been received. We will get back to you shortly!', 'success');

        return redirect()->back()->with('contact_success', true);
    }
}
