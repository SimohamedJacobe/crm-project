<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     */
    public function index(): View
    {
        $companies = Company::withCount(['contacts', 'deals'])
            ->latest()
            ->paginate(15);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     */
    public function create(): View
    {
        return view('companies.create');
    }

    /**
     * Store a newly created company in storage.
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        Company::create($request->validated());

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company): View
    {
        $company->load(['contacts', 'deals']);

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit(Company $company): View
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $company->update($request->validated());

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified company from storage (soft delete).
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
