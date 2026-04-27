@extends('layouts.app')

@section('title', 'Add Company')

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size:.8rem;">
        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="text-decoration-none" style="color:#64748b;">Companies</a></li>
        <li class="breadcrumb-item active" style="color:#94a3b8;">New Company</li>
    </ol>
</nav>

<div class="page-header">
    <h1><i class="bi bi-buildings me-2" style="color:#818cf8;"></i>Add Company</h1>
    <p>Fill in the details below to create a new company record.</p>
</div>

<div class="row g-4">
    {{-- Form --}}
    <div class="col-lg-8">
        <form action="{{ route('companies.store') }}" method="POST" novalidate>
            @csrf

            {{-- Basic Info --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-info-circle me-2" style="color:#818cf8;"></i>Basic Information
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Acme Corporation"
                               autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="contact@company.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="+1 (555) 000-0000">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Online Presence --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-globe2 me-2" style="color:#818cf8;"></i>Online Presence
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label for="website" class="form-label">Website</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                <i class="bi bi-link-45deg"></i>
                            </span>
                            <input type="url"
                                   class="form-control @error('website') is-invalid @enderror"
                                   id="website"
                                   name="website"
                                   value="{{ old('website') }}"
                                   placeholder="https://www.company.com">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">Include the full URL starting with https://</div>
                    </div>
                </div>
            </div>

            {{-- Address --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-geo-alt me-2" style="color:#818cf8;"></i>Address
                </div>
                <div class="card-body p-4">
                    <div>
                        <label for="address" class="form-label">Full Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror"
                                  id="address"
                                  name="address"
                                  rows="3"
                                  placeholder="123 Main Street, City, State, ZIP, Country">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bi bi-check-lg"></i> Save Company
                </button>
                <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header py-3 px-4">
                <i class="bi bi-lightbulb me-2" style="color:#fcd34d;"></i>Tips
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled mb-0" style="font-size:.83rem;color:#64748b;">
                    <li class="d-flex gap-2 mb-2">
                        <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="color:#22c55e;font-size:.75rem;"></i>
                        Only the company <strong style="color:#94a3b8;">name</strong> is required.
                    </li>
                    <li class="d-flex gap-2 mb-2">
                        <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="color:#22c55e;font-size:.75rem;"></i>
                        A complete profile helps you track interactions faster.
                    </li>
                    <li class="d-flex gap-2">
                        <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="color:#22c55e;font-size:.75rem;"></i>
                        You can link contacts and deals after creating the company.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
