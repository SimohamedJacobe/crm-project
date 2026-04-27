@extends('layouts.app')

@section('title', 'Contacts')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1><i class="bi bi-person-lines-fill me-2" style="color:#86efac;"></i>Contacts</h1>
        <p>Manage all your people and their relationships to companies.</p>
    </div>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Add Contact
    </a>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:44px;height:44px;background:rgba(34,197,94,.12);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-person-fill" style="color:#86efac;font-size:1.15rem;"></i>
                </div>
                <div>
                    <div style="font-size:.75rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Total Contacts</div>
                    <div style="font-size:1.6rem;font-weight:700;color:#f1f5f9;line-height:1.2;">{{ $contacts->total() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between py-3 px-4">
        <span class="d-flex align-items-center gap-2">
            <i class="bi bi-table" style="color:#86efac;"></i> All Contacts
        </span>
        <span class="badge rounded-pill" style="background:rgba(34,197,94,.1);color:#86efac;font-size:.75rem;">
            {{ $contacts->total() }} records
        </span>
    </div>

    @if($contacts->isEmpty())
        <div class="card-body text-center py-5">
            <div style="width:64px;height:64px;background:rgba(34,197,94,.08);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <i class="bi bi-person-plus" style="color:#86efac;font-size:1.75rem;"></i>
            </div>
            <h5 class="fw-semibold mb-1" style="color:#f1f5f9;">No contacts yet</h5>
            <p class="text-muted mb-3" style="font-size:.875rem;">Get started by adding your first contact.</p>
            <a href="{{ route('contacts.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Contact
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="padding-left:1.5rem;">Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Job Title</th>
                        <th style="padding-right:1.5rem;text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td style="padding-left:1.5rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:38px;height:38px;background:linear-gradient(135deg,rgba(34,197,94,.2),rgba(34,197,94,.08));border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#86efac;font-size:.8rem;flex-shrink:0;">
                                    {{ strtoupper(substr($contact->first_name,0,1).substr($contact->last_name,0,1)) }}
                                </div>
                                <div>
                                    <a href="{{ route('contacts.show', $contact) }}" class="fw-semibold text-decoration-none" style="color:#f1f5f9;">
                                        {{ $contact->first_name }} {{ $contact->last_name }}
                                    </a>
                                    @if($contact->job_title)
                                        <div style="font-size:.75rem;color:#475569;">{{ $contact->job_title }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($contact->company)
                                <a href="{{ route('companies.show', $contact->company) }}" class="text-decoration-none d-flex align-items-center gap-2" style="color:#818cf8;font-size:.875rem;">
                                    <div style="width:22px;height:22px;background:rgba(99,102,241,.15);border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:.6rem;font-weight:700;color:#818cf8;">
                                        {{ strtoupper(substr($contact->company->name,0,2)) }}
                                    </div>
                                    {{ $contact->company->name }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="mailto:{{ $contact->email }}" class="text-decoration-none" style="color:#94a3b8;font-size:.875rem;">{{ $contact->email }}</a>
                        </td>
                        <td style="color:#94a3b8;font-size:.875rem;">{{ $contact->phone ?? '—' }}</td>
                        <td style="color:#94a3b8;font-size:.875rem;">{{ $contact->job_title ?? '—' }}</td>
                        <td style="padding-right:1.5rem;text-align:right;">
                            <div class="d-flex align-items-center justify-content-end gap-1">
                                <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-outline-secondary" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                                      onsubmit="return confirm('Delete {{ addslashes($contact->first_name.' '.$contact->last_name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash3"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($contacts->hasPages())
            <div class="card-footer border-0 py-3 px-4" style="background:transparent;">
                {{ $contacts->links() }}
            </div>
        @endif
    @endif
</div>

@endsection
