@extends('layouts.app')

@section('title', 'Add Contact')

@section('content')

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size:.8rem;">
        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}" class="text-decoration-none" style="color:#64748b;">Contacts</a></li>
        <li class="breadcrumb-item active" style="color:#94a3b8;">New Contact</li>
    </ol>
</nav>

<div class="page-header">
    <h1><i class="bi bi-person-plus me-2" style="color:#86efac;"></i>Add Contact</h1>
    <p>Fill in the details below to create a new contact record.</p>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('contacts.store') }}" method="POST" novalidate>
            @csrf

            {{-- Personal Info --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-person me-2" style="color:#86efac;"></i>Personal Information
                </div>
                <div class="card-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                   id="first_name" name="first_name" value="{{ old('first_name') }}"
                                   placeholder="Jane" autofocus>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   id="last_name" name="last_name" value="{{ old('last_name') }}"
                                   placeholder="Smith">
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="job_title" class="form-label">Job Title</label>
                        <input type="text" class="form-control @error('job_title') is-invalid @enderror"
                               id="job_title" name="job_title" value="{{ old('job_title') }}"
                               placeholder="e.g. Chief Technology Officer">
                        @error('job_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Contact Details --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-envelope me-2" style="color:#86efac;"></i>Contact Details
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}"
                                   placeholder="jane.smith@company.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone') }}"
                                   placeholder="+1 (555) 000-0000">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Association --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-buildings me-2" style="color:#86efac;"></i>Association
                </div>
                <div class="card-body p-4">
                    <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                    <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id">
                        <option value="" disabled {{ old('company_id') ? '' : 'selected' }}>— Select a company —</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">
                        Can't find the company? <a href="{{ route('companies.create') }}" target="_blank" style="color:#818cf8;">Create one first.</a>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bi bi-check-lg"></i> Save Contact
                </button>
                <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header py-3 px-4">
                <i class="bi bi-lightbulb me-2" style="color:#fcd34d;"></i>Tips
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled mb-0" style="font-size:.83rem;color:#64748b;">
                    <li class="d-flex gap-2 mb-2">
                        <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="color:#22c55e;font-size:.75rem;"></i>
                        First name, last name, email, and company are required.
                    </li>
                    <li class="d-flex gap-2 mb-2">
                        <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="color:#22c55e;font-size:.75rem;"></i>
                        Each contact must have a unique email address.
                    </li>
                    <li class="d-flex gap-2">
                        <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="color:#22c55e;font-size:.75rem;"></i>
                        You can link deals to this contact after saving.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
