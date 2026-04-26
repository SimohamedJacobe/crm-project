<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Company;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Display a listing of the contacts.
     */
    public function index(): View
    {
        $contacts = Contact::with('company')
            ->latest()
            ->paginate(15);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact.
     */
    public function create(): View
    {
        $companies = Company::orderBy('name')->get();

        return view('contacts.create', compact('companies'));
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(StoreContactRequest $request): RedirectResponse
    {
        Contact::create($request->validated());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified contact.
     */
    public function show(Contact $contact): View
    {
        $contact->load(['company', 'deals']);

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit(Contact $contact): View
    {
        $companies = Company::orderBy('name')->get();

        return view('contacts.edit', compact('contact', 'companies'));
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact): RedirectResponse
    {
        $contact->update($request->validated());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified contact from storage (soft delete).
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
