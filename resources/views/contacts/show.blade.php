@extends('layouts.app')

@section('title', $contact->first_name . ' ' . $contact->last_name)

@section('content')

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size:.8rem;">
        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}" class="text-decoration-none" style="color:#64748b;">Contacts</a></li>
        <li class="breadcrumb-item active" style="color:#94a3b8;">{{ $contact->first_name }} {{ $contact->last_name }}</li>
    </ol>
</nav>

{{-- Contact Hero --}}
<div class="card mb-4" style="background:linear-gradient(135deg,#1e293b 0%,#162032 100%);">
    <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-4">
                <div style="width:64px;height:64px;background:linear-gradient(135deg,rgba(34,197,94,.25),rgba(34,197,94,.08));border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;color:#86efac;font-size:1.4rem;flex-shrink:0;">
                    {{ strtoupper(substr($contact->first_name,0,1).substr($contact->last_name,0,1)) }}
                </div>
                <div>
                    <h2 class="mb-1 fw-bold" style="color:#f1f5f9;">{{ $contact->first_name }} {{ $contact->last_name }}</h2>
                    @if($contact->job_title)
                        <div style="color:#64748b;font-size:.875rem;" class="mb-1">{{ $contact->job_title }}</div>
                    @endif
                    <div class="d-flex flex-wrap gap-3" style="font-size:.83rem;color:#64748b;">
                        <a href="mailto:{{ $contact->email }}" class="text-decoration-none d-flex align-items-center gap-1" style="color:#94a3b8;">
                            <i class="bi bi-envelope"></i> {{ $contact->email }}
                        </a>
                        @if($contact->phone)
                            <span class="d-flex align-items-center gap-1">
                                <i class="bi bi-telephone"></i> {{ $contact->phone }}
                            </span>
                        @endif
                        @if($contact->company)
                            <a href="{{ route('companies.show', $contact->company) }}" class="text-decoration-none d-flex align-items-center gap-1" style="color:#818cf8;">
                                <i class="bi bi-buildings"></i> {{ $contact->company->name }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
        </div>
    </div>
</div>

{{-- Deals --}}
<div class="card">
    <div class="card-header py-3 px-4 d-flex align-items-center justify-content-between">
        <span><i class="bi bi-briefcase me-2" style="color:#fcd34d;"></i>Associated Deals</span>
        <span class="count-badge" style="background:rgba(245,158,11,.1);color:#fcd34d;">{{ $contact->deals->count() }}</span>
    </div>
    <div class="card-body p-0">
        @forelse($contact->deals as $deal)
            @php
                $stageColors = [
                    'Lead'      => ['bg'=>'rgba(99,102,241,.15)','color'=>'#818cf8'],
                    'Qualified' => ['bg'=>'rgba(56,189,248,.12)','color'=>'#7dd3fc'],
                    'Proposal'  => ['bg'=>'rgba(245,158,11,.12)','color'=>'#fcd34d'],
                    'Won'       => ['bg'=>'rgba(34,197,94,.12)', 'color'=>'#86efac'],
                    'Lost'      => ['bg'=>'rgba(239,68,68,.12)', 'color'=>'#fca5a5'],
                ];
                $sc = $stageColors[$deal->stage] ?? ['bg'=>'rgba(100,116,139,.15)','color'=>'#94a3b8'];
            @endphp
            <div class="d-flex align-items-center gap-3 px-4 py-3" style="border-bottom:1px solid rgba(255,255,255,.04);">
                <div class="flex-grow-1">
                    <div class="fw-semibold" style="color:#f1f5f9;font-size:.875rem;">{{ $deal->title }}</div>
                    <div style="font-size:.75rem;color:#475569;">${{ number_format($deal->amount, 2) }}
                        @if($deal->expected_close_date)
                            · Closes {{ $deal->expected_close_date->format('M d, Y') }}
                        @endif
                    </div>
                </div>
                <span class="badge rounded-pill" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};font-size:.7rem;">{{ $deal->stage }}</span>
                <a href="{{ route('deals.show', $deal) }}" class="btn btn-sm btn-outline-secondary flex-shrink-0">
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @empty
            <div class="text-center py-4">
                <i class="bi bi-briefcase d-block mb-2" style="color:#334155;font-size:1.5rem;"></i>
                <span style="font-size:.8rem;color:#475569;">No deals linked to this contact yet.</span>
            </div>
        @endforelse
    </div>
</div>

@endsection
