<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use App\Models\Project;
use App\Models\ContactMessage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'messages' => ContactMessage::count(),
            'conversion' => '18.2%' // Static for now as in the template
        ];
        
        $recentProjects = Project::latest()->take(5)->get();
        return view('admin.index', compact('stats', 'recentProjects'));
    }

    public function portfolio(): View
    {
        $projects = Project::latest()->get();
        return view('admin.portfolio', compact('projects'));
    }

    public function services(): View
    {
        $services = Service::all();
        return view('admin.services', compact('services'));
    }

    public function messages(): View
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    public function settings(): View
    {
        return view('admin.settings');
    }

    // --- Projects CRUD ---

    public function storeProject(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|in:Web Application,Mobile App,Branding,UI/UX Design,E-Commerce,Other',
            'year'        => 'required|integer|min:2000|max:2100',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);
        notify('Project created successfully!');
        return redirect()->route('admin.portfolio');
    }

    public function updateProject(Request $request, $id): RedirectResponse
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|in:Web Application,Mobile App,Branding,UI/UX Design,E-Commerce,Other',
            'year'        => 'required|integer|min:2000|max:2100',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);
        notify('Project updated successfully!');
        return redirect()->route('admin.portfolio');
    }

    public function deleteProject($id): RedirectResponse
    {
        $project = Project::findOrFail($id);

        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }

        $project->delete();
        notify('Project deleted successfully!', 'info');
        return redirect()->route('admin.portfolio');
    }

    // --- Services CRUD ---

    public function storeService(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'description' => 'required|string',
            'icon' => 'required|string|max:100',
            'tags' => 'nullable|string',
        ]);

        Service::create($validated);
        notify('Service created successfully!');
        return redirect()->route('admin.services');
    }

    public function updateService(Request $request, $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'description' => 'required|string',
            'icon' => 'required|string|max:100',
            'tags' => 'nullable|string',
        ]);

        $service->update($validated);
        notify('Service updated successfully!');
        return redirect()->route('admin.services');
    }

    public function deleteService($id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();
        notify('Service deleted successfully!', 'info');
        return redirect()->route('admin.services');
    }

    public function deleteMessage($id): RedirectResponse
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        notify('Message deleted successfully!', 'info');
        return redirect()->route('admin.messages');
    }
}
