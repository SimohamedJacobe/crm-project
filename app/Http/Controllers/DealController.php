<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Company;
use App\Models\Contact;
use App\Http\Requests\StoreDealRequest;
use App\Http\Requests\UpdateDealRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DealController extends Controller
{
    /**
     * The valid pipeline stages for a deal.
     */
    public const STAGES = ['Lead', 'Qualified', 'Proposal', 'Won', 'Lost'];

    /**
     * Display a listing of the deals.
     */
    public function index(): View
    {
        $deals = Deal::with(['company', 'contact'])
            ->latest()
            ->paginate(15);

        return view('deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new deal.
     */
    public function create(): View
    {
        $companies = Company::orderBy('name')->get();
        $contacts = Contact::orderBy('first_name')->get();
        $stages = self::STAGES;

        return view('deals.create', compact('companies', 'contacts', 'stages'));
    }

    /**
     * Store a newly created deal in storage.
     */
    public function store(StoreDealRequest $request): RedirectResponse
    {
        Deal::create($request->validated());

        return redirect()->route('deals.index')
            ->with('success', 'Deal created successfully.');
    }

    /**
     * Display the specified deal.
     */
    public function show(Deal $deal): View
    {
        $deal->load(['company', 'contact']);

        return view('deals.show', compact('deal'));
    }

    /**
     * Show the form for editing the specified deal.
     */
    public function edit(Deal $deal): View
    {
        $companies = Company::orderBy('name')->get();
        $contacts = Contact::orderBy('first_name')->get();
        $stages = self::STAGES;

        return view('deals.edit', compact('deal', 'companies', 'contacts', 'stages'));
    }

    /**
     * Update the specified deal in storage.
     */
    public function update(UpdateDealRequest $request, Deal $deal): RedirectResponse
    {
        $deal->update($request->validated());

        return redirect()->route('deals.index')
            ->with('success', 'Deal updated successfully.');
    }

    /**
     * Remove the specified deal from storage (soft delete).
     */
    public function destroy(Deal $deal): RedirectResponse
    {
        $deal->delete();

        return redirect()->route('deals.index')
            ->with('success', 'Deal deleted successfully.');
    }
}
