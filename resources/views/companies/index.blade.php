@extends('layouts.app')

@section('title', 'Companies')

@section('content')

{{-- Page Header --}}
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1><i class="bi bi-buildings me-2" style="color:#818cf8;"></i>Companies</h1>
        <p>Manage all your company accounts and relationships.</p>
    </div>
    <a href="{{ route('companies.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Add Company
    </a>
</div>

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:44px;height:44px;background:rgba(99,102,241,.15);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-buildings-fill" style="color:#818cf8;font-size:1.15rem;"></i>
                </div>
                <div>
                    <div style="font-size:.75rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Total Companies</div>
                    <div style="font-size:1.6rem;font-weight:700;color:#f1f5f9;line-height:1.2;">{{ $companies->total() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between py-3 px-4">
        <span class="d-flex align-items-center gap-2">
            <i class="bi bi-table" style="color:#818cf8;"></i> All Companies
        </span>
        <span class="badge rounded-pill" style="background:rgba(99,102,241,.15);color:#818cf8;font-size:.75rem;">
            {{ $companies->total() }} records
        </span>
    </div>

    @if($companies->isEmpty())
        <div class="card-body text-center py-5">
            <div style="width:64px;height:64px;background:rgba(99,102,241,.1);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <i class="bi bi-buildings" style="color:#818cf8;font-size:1.75rem;"></i>
            </div>
            <h5 class="fw-semibold mb-1" style="color:#f1f5f9;">No companies yet</h5>
            <p class="text-muted mb-3" style="font-size:.875rem;">Get started by adding your first company.</p>
            <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Company
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="padding-left:1.5rem;">Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Website</th>
                        <th class="text-center">Contacts</th>
                        <th class="text-center">Deals</th>
                        <th style="padding-right:1.5rem;text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr>
                        <td style="padding-left:1.5rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:38px;height:38px;background:linear-gradient(135deg,rgba(99,102,241,.2),rgba(99,102,241,.1));border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:700;color:#818cf8;font-size:.85rem;">
                                    {{ strtoupper(substr($company->name, 0, 2)) }}
                                </div>
                                <div>
                                    <a href="{{ route('companies.show', $company) }}" class="fw-semibold text-decoration-none" style="color:#f1f5f9;">
                                        {{ $company->name }}
                                    </a>
                                    @if($company->address)
                                        <div style="font-size:.75rem;color:#475569;">{{ Str::limit($company->address, 40) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($company->email)
                                <a href="mailto:{{ $company->email }}" class="text-decoration-none" style="color:#94a3b8;font-size:.875rem;">
                                    {{ $company->email }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td style="color:#94a3b8;font-size:.875rem;">{{ $company->phone ?? '—' }}</td>
                        <td>
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank" class="text-decoration-none d-flex align-items-center gap-1" style="color:#818cf8;font-size:.875rem;">
                                    <i class="bi bi-box-arrow-up-right" style="font-size:.7rem;"></i>
                                    {{ parse_url($company->website, PHP_URL_HOST) ?? $company->website }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="count-badge">{{ $company->contacts_count }}</span>
                        </td>
                        <td class="text-center">
                            <span class="count-badge" style="background:rgba(34,197,94,.1);color:#86efac;">{{ $company->deals_count }}</span>
                        </td>
                        <td style="padding-right:1.5rem;text-align:right;">
                            <div class="d-flex align-items-center justify-content-end gap-1">
                                <a href="{{ route('companies.show', $company) }}"
                                   class="btn btn-sm btn-outline-secondary"
                                   title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('companies.edit', $company) }}"
                                   class="btn btn-sm btn-outline-secondary"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('companies.destroy', $company) }}" method="POST"
                                      onsubmit="return confirm('Delete {{ addslashes($company->name) }}? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($companies->hasPages())
            <div class="card-footer border-0 py-3 px-4" style="background:transparent;">
                {{ $companies->links() }}
            </div>
        @endif
    @endif
</div>

@endsection
