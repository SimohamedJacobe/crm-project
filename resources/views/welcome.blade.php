@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-header">
    <h1><i class="bi bi-speedometer2 me-2" style="color:#818cf8;"></i>Dashboard</h1>
    <p>Welcome back. Here's what's happening across your CRM.</p>
</div>

{{-- KPI Cards --}}
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('companies.index') }}" class="text-decoration-none">
            <div class="card h-100" style="transition:transform .2s,box-shadow .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 32px rgba(0,0,0,.4)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div style="width:48px;height:48px;background:linear-gradient(135deg,rgba(99,102,241,.25),rgba(99,102,241,.1));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-buildings-fill" style="color:#818cf8;font-size:1.2rem;"></i>
                        </div>
                        <i class="bi bi-arrow-up-right" style="color:#334155;font-size:.9rem;"></i>
                    </div>
                    <div style="font-size:2rem;font-weight:800;color:#f1f5f9;line-height:1;">{{ number_format($companiesCount) }}</div>
                    <div style="font-size:.8rem;color:#64748b;margin-top:.25rem;font-weight:500;">Companies</div>
                    <div style="height:3px;background:linear-gradient(90deg,#6366f1,#818cf8);border-radius:2px;margin-top:1rem;"></div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('contacts.index') }}" class="text-decoration-none">
            <div class="card h-100" style="transition:transform .2s,box-shadow .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 32px rgba(0,0,0,.4)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div style="width:48px;height:48px;background:linear-gradient(135deg,rgba(34,197,94,.2),rgba(34,197,94,.07));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person-fill" style="color:#86efac;font-size:1.2rem;"></i>
                        </div>
                        <i class="bi bi-arrow-up-right" style="color:#334155;font-size:.9rem;"></i>
                    </div>
                    <div style="font-size:2rem;font-weight:800;color:#f1f5f9;line-height:1;">{{ number_format($contactsCount) }}</div>
                    <div style="font-size:.8rem;color:#64748b;margin-top:.25rem;font-weight:500;">Contacts</div>
                    <div style="height:3px;background:linear-gradient(90deg,#22c55e,#86efac);border-radius:2px;margin-top:1rem;"></div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('deals.index') }}" class="text-decoration-none">
            <div class="card h-100" style="transition:transform .2s,box-shadow .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 32px rgba(0,0,0,.4)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div style="width:48px;height:48px;background:linear-gradient(135deg,rgba(245,158,11,.2),rgba(245,158,11,.07));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-briefcase-fill" style="color:#fcd34d;font-size:1.2rem;"></i>
                        </div>
                        <i class="bi bi-arrow-up-right" style="color:#334155;font-size:.9rem;"></i>
                    </div>
                    <div style="font-size:2rem;font-weight:800;color:#f1f5f9;line-height:1;">{{ number_format($dealsCount) }}</div>
                    <div style="font-size:.8rem;color:#64748b;margin-top:.25rem;font-weight:500;">Total Deals</div>
                    <div style="height:3px;background:linear-gradient(90deg,#f59e0b,#fcd34d);border-radius:2px;margin-top:1rem;"></div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div style="width:48px;height:48px;background:linear-gradient(135deg,rgba(56,189,248,.2),rgba(56,189,248,.07));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-currency-dollar" style="color:#7dd3fc;font-size:1.3rem;"></i>
                    </div>
                    <span class="badge" style="background:rgba(34,197,94,.12);color:#86efac;font-size:.7rem;">{{ $wonCount }} Won</span>
                </div>
                <div style="font-size:1.6rem;font-weight:800;color:#f1f5f9;line-height:1;">${{ number_format($totalValue, 0) }}</div>
                <div style="font-size:.8rem;color:#64748b;margin-top:.25rem;font-weight:500;">Pipeline Value</div>
                <div style="height:3px;background:linear-gradient(90deg,#38bdf8,#7dd3fc);border-radius:2px;margin-top:1rem;"></div>
            </div>
        </div>
    </div>

</div>

<div class="row g-4">
    {{-- Recent Deals --}}
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header py-3 px-4 d-flex align-items-center justify-content-between">
                <span><i class="bi bi-briefcase me-2" style="color:#fcd34d;"></i>Recent Deals</span>
                <a href="{{ route('deals.index') }}" class="btn btn-sm btn-outline-secondary" style="font-size:.75rem;">View All</a>
            </div>
            @if($recentDeals->isEmpty())
                <div class="card-body text-center py-5">
                    <i class="bi bi-briefcase d-block mb-2" style="color:#334155;font-size:1.5rem;"></i>
                    <p class="text-muted mb-0" style="font-size:.875rem;">No deals yet. <a href="{{ route('deals.create') }}" style="color:#818cf8;">Create one.</a></p>
                </div>
            @else
                <div class="card-body p-0">
                    @php
                    $stageColors = [
                        'Lead'      => ['bg'=>'rgba(99,102,241,.15)', 'color'=>'#818cf8'],
                        'Qualified' => ['bg'=>'rgba(56,189,248,.12)', 'color'=>'#7dd3fc'],
                        'Proposal'  => ['bg'=>'rgba(245,158,11,.12)', 'color'=>'#fcd34d'],
                        'Won'       => ['bg'=>'rgba(34,197,94,.12)',  'color'=>'#86efac'],
                        'Lost'      => ['bg'=>'rgba(239,68,68,.12)',  'color'=>'#fca5a5'],
                    ];
                    @endphp
                    @foreach($recentDeals as $deal)
                    @php $sc = $stageColors[$deal->stage] ?? ['bg'=>'rgba(100,116,139,.15)','color'=>'#94a3b8']; @endphp
                    <div class="d-flex align-items-center gap-3 px-4 py-3" style="border-bottom:1px solid rgba(255,255,255,.04);">
                        <div style="width:40px;height:40px;background:rgba(245,158,11,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-briefcase" style="color:#fcd34d;font-size:.85rem;"></i>
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <a href="{{ route('deals.show', $deal) }}" class="fw-semibold text-decoration-none d-block text-truncate" style="color:#f1f5f9;font-size:.875rem;">{{ $deal->title }}</a>
                            <div style="font-size:.75rem;color:#475569;">
                                @if($deal->company){{ $deal->company->name }}@endif
                                @if($deal->contact)· {{ $deal->contact->first_name }} {{ $deal->contact->last_name }}@endif
                            </div>
                        </div>
                        <div class="text-end flex-shrink-0">
                            <div class="fw-semibold" style="color:#f1f5f9;font-size:.875rem;">${{ number_format($deal->amount, 0) }}</div>
                            <span class="badge rounded-pill" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};font-size:.65rem;">{{ $deal->stage }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Quick Actions + Pipeline Summary --}}
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header py-3 px-4">
                <i class="bi bi-lightning me-2" style="color:#818cf8;"></i>Quick Actions
            </div>
            <div class="card-body p-3">
                <div class="d-grid gap-2">
                    <a href="{{ route('companies.create') }}" class="btn btn-outline-secondary text-start d-flex align-items-center gap-2 px-3 py-2" style="font-size:.85rem;">
                        <div style="width:28px;height:28px;background:rgba(99,102,241,.15);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-buildings" style="color:#818cf8;font-size:.75rem;"></i>
                        </div>
                        Add Company
                    </a>
                    <a href="{{ route('contacts.create') }}" class="btn btn-outline-secondary text-start d-flex align-items-center gap-2 px-3 py-2" style="font-size:.85rem;">
                        <div style="width:28px;height:28px;background:rgba(34,197,94,.1);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-person-plus" style="color:#86efac;font-size:.75rem;"></i>
                        </div>
                        Add Contact
                    </a>
                    <a href="{{ route('deals.create') }}" class="btn btn-outline-secondary text-start d-flex align-items-center gap-2 px-3 py-2" style="font-size:.85rem;">
                        <div style="width:28px;height:28px;background:rgba(245,158,11,.1);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-briefcase" style="color:#fcd34d;font-size:.75rem;"></i>
                        </div>
                        Add Deal
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header py-3 px-4">
                <i class="bi bi-funnel me-2" style="color:#818cf8;"></i>Pipeline Summary
            </div>
            <div class="card-body p-4">
                @foreach(['Lead'=>['#818cf8','rgba(99,102,241,.15)'],'Qualified'=>['#7dd3fc','rgba(56,189,248,.12)'],'Proposal'=>['#fcd34d','rgba(245,158,11,.12)'],'Won'=>['#86efac','rgba(34,197,94,.12)'],'Lost'=>['#fca5a5','rgba(239,68,68,.12)']] as $stage => [$color, $bg])
                @php $count = \App\Models\Deal::where('stage', $stage)->count(); @endphp
                <div class="d-flex align-items-center justify-content-between mb-{{ $loop->last ? '0' : '3' }}">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:8px;height:8px;background:{{ $color }};border-radius:50%;"></div>
                        <span style="font-size:.83rem;color:#94a3b8;">{{ $stage }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:80px;height:4px;background:rgba(255,255,255,.05);border-radius:2px;overflow:hidden;">
                            <div style="width:{{ $dealsCount > 0 ? round(($count / $dealsCount) * 100) : 0 }}%;height:100%;background:{{ $color }};border-radius:2px;transition:width .4s;"></div>
                        </div>
                        <span style="font-size:.8rem;color:#64748b;width:16px;text-align:right;">{{ $count }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
