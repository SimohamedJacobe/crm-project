@extends('layouts.app')

@section('title', 'Add Deal')

@section('content')

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size:.8rem;">
        <li class="breadcrumb-item"><a href="{{ route('deals.index') }}" class="text-decoration-none" style="color:#64748b;">Deals</a></li>
        <li class="breadcrumb-item active" style="color:#94a3b8;">New Deal</li>
    </ol>
</nav>

<div class="page-header">
    <h1><i class="bi bi-briefcase me-2" style="color:#fcd34d;"></i>Add Deal</h1>
    <p>Create a new sales opportunity and track it through the pipeline.</p>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('deals.store') }}" method="POST" novalidate>
            @csrf

            {{-- Deal Info --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-briefcase me-2" style="color:#fcd34d;"></i>Deal Information
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="title" class="form-label">Deal Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}"
                               placeholder="e.g. Enterprise Software Package" autofocus>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="amount" class="form-label">Deal Value <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">$</span>
                                <input type="number" step="0.01" min="0"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       id="amount" name="amount" value="{{ old('amount') }}"
                                       placeholder="0.00">
                                @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="expected_close_date" class="form-label">Expected Close Date</label>
                            <input type="date" class="form-control @error('expected_close_date') is-invalid @enderror"
                                   id="expected_close_date" name="expected_close_date" value="{{ old('expected_close_date') }}"
                                   style="color-scheme:dark;">
                            @error('expected_close_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pipeline Stage --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-funnel me-2" style="color:#fcd34d;"></i>Pipeline Stage
                </div>
                <div class="card-body p-4">
                    <label for="stage" class="form-label">Stage <span class="text-danger">*</span></label>
                    <div class="row g-2">
                        @php
                        $stageConfig = [
                            'Lead'      => ['color'=>'#818cf8','bg'=>'rgba(99,102,241,.12)','icon'=>'bi-circle-fill','desc'=>'Initial interest'],
                            'Qualified' => ['color'=>'#7dd3fc','bg'=>'rgba(56,189,248,.12)','icon'=>'bi-lightning-fill','desc'=>'Confirmed opportunity'],
                            'Proposal'  => ['color'=>'#fcd34d','bg'=>'rgba(245,158,11,.12)','icon'=>'bi-file-text-fill','desc'=>'Proposal sent'],
                            'Won'       => ['color'=>'#86efac','bg'=>'rgba(34,197,94,.12)','icon'=>'bi-trophy-fill','desc'=>'Deal closed'],
                            'Lost'      => ['color'=>'#fca5a5','bg'=>'rgba(239,68,68,.12)','icon'=>'bi-x-circle-fill','desc'=>'Opportunity lost'],
                        ];
                        @endphp
                        @foreach($stages as $stage)
                        @php $sc = $stageConfig[$stage]; $isSelected = old('stage', 'Lead') === $stage; @endphp
                        <div class="col-6 col-sm-4">
                            <input type="radio" class="btn-check" name="stage" id="stage_{{ $stage }}" value="{{ $stage }}" {{ $isSelected ? 'checked' : '' }}>
                            <label class="btn w-100 text-start p-3" for="stage_{{ $stage }}"
                                   style="background:{{ $sc['bg'] }};border-color:transparent;transition:all .15s;">
                                <i class="bi {{ $sc['icon'] }} d-block mb-1" style="color:{{ $sc['color'] }};font-size:.85rem;"></i>
                                <span class="fw-semibold" style="color:{{ $sc['color'] }};font-size:.8rem;">{{ $stage }}</span>
                                <div style="color:#64748b;font-size:.7rem;">{{ $sc['desc'] }}</div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('stage')<div class="text-danger mt-1" style="font-size:.78rem;">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Associations --}}
            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-link-45deg me-2" style="color:#fcd34d;"></i>Associations
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
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
                    </div>
                    <div>
                        <label for="contact_id" class="form-label">Contact <span style="color:#64748b;font-size:.75rem;">(optional)</span></label>
                        <select class="form-select @error('contact_id') is-invalid @enderror" id="contact_id" name="contact_id">
                            <option value="">— No specific contact —</option>
                            @foreach($contacts as $contact)
                                <option value="{{ $contact->id }}" {{ old('contact_id') == $contact->id ? 'selected' : '' }}>
                                    {{ $contact->first_name }} {{ $contact->last_name }}
                                    @if($contact->company)· {{ $contact->company->name }}@endif
                                </option>
                            @endforeach
                        </select>
                        @error('contact_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bi bi-check-lg"></i> Save Deal
                </button>
                <a href="{{ route('deals.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header py-3 px-4">
                <i class="bi bi-diagram-2 me-2" style="color:#fcd34d;"></i>Pipeline Stages
            </div>
            <div class="card-body p-4">
                <ol class="list-unstyled mb-0">
                    @foreach(['Lead'=>'Initial prospect identified','Qualified'=>'Budget & need confirmed','Proposal'=>'Quote or proposal sent','Won'=>'Contract signed','Lost'=>'Opportunity did not progress'] as $s => $d)
                    <li class="d-flex gap-2 mb-3 {{ $loop->last ? 'mb-0' : '' }}">
                        <div style="width:6px;background:{{ ['Lead'=>'#818cf8','Qualified'=>'#7dd3fc','Proposal'=>'#fcd34d','Won'=>'#86efac','Lost'=>'#fca5a5'][$s] }};border-radius:3px;flex-shrink:0;"></div>
                        <div>
                            <div class="fw-semibold" style="font-size:.8rem;color:#94a3b8;">{{ $s }}</div>
                            <div style="font-size:.75rem;color:#475569;">{{ $d }}</div>
                        </div>
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>

@endsection
