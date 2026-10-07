<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FaqController extends Controller
{
    /**
     * Display a listing of the FAQs.
     */
    public function index(): View
    {
        $faqs = Faq::orderBy('order', 'asc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question'     => 'required|string|max:255',
            'answer'       => 'required|string',
            'order'        => 'required|integer',
            'is_published' => 'nullable',
        ]);

        // If the checkbox is checked, it will be in the request. If not, default to false.
        $validated['is_published'] = $request->has('is_published');

        Faq::create($validated);

        notify('FAQ created successfully!', 'success');

        return redirect()->back();
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question'     => 'required|string|max:255',
            'answer'       => 'required|string',
            'order'        => 'required|integer',
            'is_published' => 'nullable',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $faq->update($validated);

        notify('FAQ updated successfully!', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function delete($id): RedirectResponse
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        notify('FAQ deleted successfully!', 'info');

        return redirect()->back();
    }
}
