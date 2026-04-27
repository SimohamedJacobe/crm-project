@extends('layouts.app')

@section('title', 'Edit — ' . $contact->first_name . ' ' . $contact->last_name)

@section('content')

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size:.8rem;">
        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}" class="text-decoration-none" style="color:#64748b;">Contacts</a></li>
        <li class="breadcrumb-item"><a href="{{ route('contacts.show', $contact) }}" class="text-decoration-none" style="color:#64748b;">{{ $contact->first_name }} {{ $contact->last_name }}</a></li>
        <li class="breadcrumb-item active" style="color:#94a3b8;">Edit</li>
    </ol>
</nav>

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1><i class="bi bi-pencil-square me-2" style="color:#86efac;"></i>Edit Contact</h1>
        <p>Updating <strong style="color:#94a3b8;">{{ $contact->first_name }} {{ $contact->last_name }}</strong></p>
    </div>
    <a href="{{ route('contacts.show', $contact) }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('contacts.update', $contact) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-person me-2" style="color:#86efac;"></i>Personal Information
                </div>
                <div class="card-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                   id="first_name" name="first_name" value="{{ old('first_name', $contact->first_name) }}" autofocus>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   id="last_name" name="last_name" value="{{ old('last_name', $contact->last_name) }}">
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="job_title" class="form-label">Job Title</label>
                        <input type="text" class="form-control @error('job_title') is-invalid @enderror"
                               id="job_title" name="job_title" value="{{ old('job_title', $contact->job_title) }}">
                        @error('job_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

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
                                   id="email" name="email" value="{{ old('email', $contact->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone', $contact->phone) }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-buildings me-2" style="color:#86efac;"></i>Association
                </div>
                <div class="card-body p-4">
                    <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                    <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id">
                        <option value="" disabled>— Select a company —</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id', $contact->company_id) == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bi bi-check-lg"></i> Save Changes
                </button>
                <a href="{{ route('contacts.show', $contact) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header py-3 px-4">
                <i class="bi bi-clock-history me-2" style="color:#86efac;"></i>Record Info
            </div>
            <div class="card-body p-4">
                <dl class="mb-0" style="font-size:.83rem;">
                    <dt style="color:#475569;font-weight:500;text-transform:uppercase;font-size:.7rem;letter-spacing:.05em;">Created</dt>
                    <dd style="color:#94a3b8;" class="mb-3">{{ $contact->created_at->format('M d, Y') }}</dd>
                    <dt style="color:#475569;font-weight:500;text-transform:uppercase;font-size:.7rem;letter-spacing:.05em;">Last Updated</dt>
                    <dd style="color:#94a3b8;" class="mb-0">{{ $contact->updated_at->format('M d, Y') }}</dd>
                </dl>
            </div>
        </div>
        <div class="card" style="border-color:rgba(239,68,68,.2);">
            <div class="card-header py-3 px-4" style="border-color:rgba(239,68,68,.2);">
                <i class="bi bi-exclamation-triangle me-2" style="color:#f87171;"></i>
                <span style="color:#f87171;">Danger Zone</span>
            </div>
            <div class="card-body p-4">
                <p style="font-size:.8rem;color:#64748b;" class="mb-3">Permanently removes this contact from the system.</p>
                <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                      onsubmit="return confirm('Delete {{ addslashes($contact->first_name.' '.$contact->last_name) }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                        <i class="bi bi-trash3 me-1"></i> Delete Contact
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
