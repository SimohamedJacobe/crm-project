@extends('layouts.app')

@section('title', $deal->title)

@section('content')

@php
$stageColors = [
    'Lead'      => ['bg'=>'rgba(99,102,241,.15)', 'color'=>'#818cf8'],
    'Qualified' => ['bg'=>'rgba(56,189,248,.12)', 'color'=>'#7dd3fc'],
    'Proposal'  => ['bg'=>'rgba(245,158,11,.12)', 'color'=>'#fcd34d'],
    'Won'       => ['bg'=>'rgba(34,197,94,.12)',  'color'=>'#86efac'],
    'Lost'      => ['bg'=>'rgba(239,68,68,.12)',  'color'=>'#fca5a5'],
];
$sc = $stageColors[$deal->stage] ?? ['bg'=>'rgba(100,116,139,.15)','color'=>'#94a3b8'];
@endphp

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size:.8rem;">
        <li class="breadcrumb-item"><a href="{{ route('deals.index') }}" class="text-decoration-none" style="color:#64748b;">Deals</a></li>
        <li class="breadcrumb-item active" style="color:#94a3b8;">{{ $deal->title }}</li>
    </ol>
</nav>

{{-- Deal Hero --}}
<div class="card mb-4" style="background:linear-gradient(135deg,#1e293b 0%,#1a2032 100%);">
    <div class="card-body p-4">
        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-4">
                <div style="width:64px;height:64px;background:rgba(245,158,11,.12);border-radius:16px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-briefcase-fill" style="color:#fcd34d;font-size:1.6rem;"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h2 class="fw-bold mb-0" style="color:#f1f5f9;">{{ $deal->title }}</h2>
                        <span class="badge rounded-pill" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};font-size:.72rem;">{{ $deal->stage }}</span>
                    </div>
                    <div style="font-size:1.4rem;font-weight:700;color:#fcd34d;" class="mb-1">
                        ${{ number_format($deal->amount, 2) }}
                    </div>
                    <div class="d-flex flex-wrap gap-3" style="font-size:.83rem;color:#64748b;">
                        @if($deal->company)
                            <a href="{{ route('companies.show', $deal->company) }}" class="text-decoration-none d-flex align-items-center gap-1" style="color:#818cf8;">
                                <i class="bi bi-buildings"></i> {{ $deal->company->name }}
                            </a>
                        @endif
                        @if($deal->contact)
                            <a href="{{ route('contacts.show', $deal->contact) }}" class="text-decoration-none d-flex align-items-center gap-1" style="color:#86efac;">
                                <i class="bi bi-person"></i> {{ $deal->contact->first_name }} {{ $deal->contact->last_name }}
                            </a>
                        @endif
                        @if($deal->expected_close_date)
                            <span class="d-flex align-items-center gap-1">
                                <i class="bi bi-calendar-event"></i> Closes {{ $deal->expected_close_date->format('M d, Y') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ route('deals.edit', $deal) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
        </div>
    </div>
</div>

{{-- Pipeline Progress --}}
<div class="card">
    <div class="card-header py-3 px-4">
        <i class="bi bi-diagram-3 me-2" style="color:#fcd34d;"></i>Pipeline Progress
    </div>
    <div class="card-body p-4">
        @php
        $allStages = ['Lead', 'Qualified', 'Proposal', 'Won', 'Lost'];
        $currentIndex = array_search($deal->stage, $allStages);
        @endphp
        <div class="d-flex align-items-center gap-0">
            @foreach($allStages as $i => $stage)
            @php
            $sc2 = $stageColors[$stage] ?? ['bg'=>'rgba(100,116,139,.15)','color'=>'#94a3b8'];
            $isCurrent = $deal->stage === $stage;
            $isPast = $deal->stage !== 'Lost' && $i < $currentIndex;
            @endphp
            <div class="flex-grow-1 text-center">
                <div class="d-flex flex-column align-items-center">
                    <div style="width:36px;height:36px;border-radius:50%;background:{{ $isCurrent ? $sc2['bg'] : ($isPast ? 'rgba(255,255,255,.05)' : 'rgba(255,255,255,.03)') }};border:2px solid {{ $isCurrent ? $sc2['color'] : 'rgba(255,255,255,.08)' }};display:flex;align-items:center;justify-content:center;margin:0 auto .4rem;transition:all .2s;">
                        @if($isCurrent)
                            <i class="bi bi-circle-fill" style="color:{{ $sc2['color'] }};font-size:.5rem;"></i>
                        @elseif($isPast)
                            <i class="bi bi-check" style="color:#475569;font-size:.8rem;"></i>
                        @endif
                    </div>
                    <div style="font-size:.7rem;font-weight:{{ $isCurrent ? '700' : '500' }};color:{{ $isCurrent ? $sc2['color'] : '#475569' }};">{{ $stage }}</div>
                </div>
            </div>
            @if(!$loop->last)
                <div style="flex:0 0 2rem;height:2px;background:rgba(255,255,255,.06);"></div>
            @endif
            @endforeach
        </div>
    </div>
</div>

@endsection
