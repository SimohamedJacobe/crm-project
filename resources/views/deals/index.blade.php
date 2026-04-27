@extends('layouts.app')

@section('title', 'Deals')

@section('content')

@php
$stageColors = [
    'Lead'      => ['bg'=>'rgba(99,102,241,.15)', 'color'=>'#818cf8',  'icon'=>'bi-circle'],
    'Qualified' => ['bg'=>'rgba(56,189,248,.12)', 'color'=>'#7dd3fc',  'icon'=>'bi-lightning'],
    'Proposal'  => ['bg'=>'rgba(245,158,11,.12)', 'color'=>'#fcd34d',  'icon'=>'bi-file-text'],
    'Won'       => ['bg'=>'rgba(34,197,94,.12)',  'color'=>'#86efac',  'icon'=>'bi-trophy'],
    'Lost'      => ['bg'=>'rgba(239,68,68,.12)',  'color'=>'#fca5a5',  'icon'=>'bi-x-circle'],
];
@endphp

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1><i class="bi bi-briefcase me-2" style="color:#fcd34d;"></i>Deals</h1>
        <p>Track your sales pipeline and opportunities.</p>
    </div>
    <a href="{{ route('deals.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Add Deal
    </a>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:44px;height:44px;background:rgba(245,158,11,.12);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-briefcase-fill" style="color:#fcd34d;font-size:1.15rem;"></i>
                </div>
                <div>
                    <div style="font-size:.75rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Total Deals</div>
                    <div style="font-size:1.6rem;font-weight:700;color:#f1f5f9;line-height:1.2;">{{ $deals->total() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between py-3 px-4">
        <span class="d-flex align-items-center gap-2">
            <i class="bi bi-table" style="color:#fcd34d;"></i> All Deals
        </span>
        <span class="badge rounded-pill" style="background:rgba(245,158,11,.1);color:#fcd34d;font-size:.75rem;">
            {{ $deals->total() }} records
        </span>
    </div>

    @if($deals->isEmpty())
        <div class="card-body text-center py-5">
            <div style="width:64px;height:64px;background:rgba(245,158,11,.08);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <i class="bi bi-briefcase" style="color:#fcd34d;font-size:1.75rem;"></i>
            </div>
            <h5 class="fw-semibold mb-1" style="color:#f1f5f9;">No deals yet</h5>
            <p class="text-muted mb-3" style="font-size:.875rem;">Start tracking your first sales opportunity.</p>
            <a href="{{ route('deals.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Deal
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="padding-left:1.5rem;">Deal</th>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Amount</th>
                        <th>Stage</th>
                        <th>Close Date</th>
                        <th style="padding-right:1.5rem;text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deals as $deal)
                    @php $sc = $stageColors[$deal->stage] ?? ['bg'=>'rgba(100,116,139,.15)','color'=>'#94a3b8','icon'=>'bi-circle']; @endphp
                    <tr>
                        <td style="padding-left:1.5rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:38px;height:38px;background:rgba(245,158,11,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="bi bi-briefcase" style="color:#fcd34d;font-size:.85rem;"></i>
                                </div>
                                <a href="{{ route('deals.show', $deal) }}" class="fw-semibold text-decoration-none" style="color:#f1f5f9;">
                                    {{ $deal->title }}
                                </a>
                            </div>
                        </td>
                        <td>
                            @if($deal->company)
                                <a href="{{ route('companies.show', $deal->company) }}" class="text-decoration-none" style="color:#818cf8;font-size:.875rem;">
                                    {{ $deal->company->name }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($deal->contact)
                                <a href="{{ route('contacts.show', $deal->contact) }}" class="text-decoration-none" style="color:#86efac;font-size:.875rem;">
                                    {{ $deal->contact->first_name }} {{ $deal->contact->last_name }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="fw-semibold" style="color:#f1f5f9;font-size:.875rem;">${{ number_format($deal->amount, 2) }}</span>
                        </td>
                        <td>
                            <span class="badge rounded-pill d-inline-flex align-items-center gap-1"
                                  style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};font-size:.7rem;">
                                <i class="bi {{ $sc['icon'] }}" style="font-size:.6rem;"></i>
                                {{ $deal->stage }}
                            </span>
                        </td>
                        <td style="color:#94a3b8;font-size:.875rem;">
                            {{ $deal->expected_close_date ? $deal->expected_close_date->format('M d, Y') : '—' }}
                        </td>
                        <td style="padding-right:1.5rem;text-align:right;">
                            <div class="d-flex align-items-center justify-content-end gap-1">
                                <a href="{{ route('deals.show', $deal) }}" class="btn btn-sm btn-outline-secondary" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('deals.edit', $deal) }}" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('deals.destroy', $deal) }}" method="POST"
                                      onsubmit="return confirm('Delete deal \'{{ addslashes($deal->title) }}\'?')">
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
        @if($deals->hasPages())
            <div class="card-footer border-0 py-3 px-4" style="background:transparent;">
                {{ $deals->links() }}
            </div>
        @endif
    @endif
</div>

@endsection
