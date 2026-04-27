@extends('layouts.app')

@section('title', 'Edit — ' . $company->name)

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size:.8rem;">
        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="text-decoration-none" style="color:#64748b;">Companies</a></li>
        <li class="breadcrumb-item"><a href="{{ route('companies.show', $company) }}" class="text-decoration-none" style="color:#64748b;">{{ $company->name }}</a></li>
        <li class="breadcrumb-item active" style="color:#94a3b8;">Edit</li>
    </ol>
</nav>

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1><i class="bi bi-pencil-square me-2" style="color:#818cf8;"></i>Edit Company</h1>
        <p>Updating <strong style="color:#94a3b8;">{{ $company->name }}</strong></p>
    </div>
    <a href="{{ route('companies.show', $company) }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row g-4">
    {{-- Form --}}
    <div class="col-lg-8">
        <form action="{{ route('companies.update', $company) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

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
                               value="{{ old('name', $company->name) }}"
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
                                       value="{{ old('email', $company->email) }}">
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
                                       value="{{ old('phone', $company->phone) }}">
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
                    <div>
                        <label for="website" class="form-label">Website</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                <i class="bi bi-link-45deg"></i>
                            </span>
                            <input type="url"
                                   class="form-control @error('website') is-invalid @enderror"
                                   id="website"
                                   name="website"
                                   value="{{ old('website', $company->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
                                  rows="3">{{ old('address', $company->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bi bi-check-lg"></i> Save Changes
                </button>
                <a href="{{ route('companies.show', $company) }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
        {{-- Meta info --}}
        <div class="card mb-3">
            <div class="card-header py-3 px-4">
                <i class="bi bi-clock-history me-2" style="color:#818cf8;"></i>Record Info
            </div>
            <div class="card-body p-4">
                <dl class="mb-0" style="font-size:.83rem;">
                    <dt style="color:#475569;font-weight:500;text-transform:uppercase;font-size:.7rem;letter-spacing:.05em;">Created</dt>
                    <dd style="color:#94a3b8;" class="mb-3">{{ $company->created_at->format('M d, Y') }}</dd>
                    <dt style="color:#475569;font-weight:500;text-transform:uppercase;font-size:.7rem;letter-spacing:.05em;">Last Updated</dt>
                    <dd style="color:#94a3b8;" class="mb-0">{{ $company->updated_at->format('M d, Y') }}</dd>
                </dl>
            </div>
        </div>

        {{-- Danger zone --}}
        <div class="card" style="border-color:rgba(239,68,68,.2);">
            <div class="card-header py-3 px-4" style="border-color:rgba(239,68,68,.2);">
                <i class="bi bi-exclamation-triangle me-2" style="color:#f87171;"></i>
                <span style="color:#f87171;">Danger Zone</span>
            </div>
            <div class="card-body p-4">
                <p style="font-size:.8rem;color:#64748b;" class="mb-3">
                    Deleting this company will also remove all associated contacts and deals permanently.
                </p>
                <form action="{{ route('companies.destroy', $company) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete {{ addslashes($company->name) }}? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                        <i class="bi bi-trash3 me-1"></i> Delete Company
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
