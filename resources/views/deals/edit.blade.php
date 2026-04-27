@extends('layouts.app')

@section('title', 'Edit — ' . $deal->title)

@section('content')

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size:.8rem;">
        <li class="breadcrumb-item"><a href="{{ route('deals.index') }}" class="text-decoration-none" style="color:#64748b;">Deals</a></li>
        <li class="breadcrumb-item"><a href="{{ route('deals.show', $deal) }}" class="text-decoration-none" style="color:#64748b;">{{ $deal->title }}</a></li>
        <li class="breadcrumb-item active" style="color:#94a3b8;">Edit</li>
    </ol>
</nav>

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1><i class="bi bi-pencil-square me-2" style="color:#fcd34d;"></i>Edit Deal</h1>
        <p>Updating <strong style="color:#94a3b8;">{{ $deal->title }}</strong></p>
    </div>
    <a href="{{ route('deals.show', $deal) }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('deals.update', $deal) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-briefcase me-2" style="color:#fcd34d;"></i>Deal Information
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="title" class="form-label">Deal Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title', $deal->title) }}" autofocus>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="amount" class="form-label">Deal Value <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">$</span>
                                <input type="number" step="0.01" min="0"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       id="amount" name="amount" value="{{ old('amount', $deal->amount) }}">
                                @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="expected_close_date" class="form-label">Expected Close Date</label>
                            <input type="date" class="form-control @error('expected_close_date') is-invalid @enderror"
                                   id="expected_close_date" name="expected_close_date"
                                   value="{{ old('expected_close_date', $deal->expected_close_date?->format('Y-m-d')) }}"
                                   style="color-scheme:dark;">
                            @error('expected_close_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-funnel me-2" style="color:#fcd34d;"></i>Pipeline Stage
                </div>
                <div class="card-body p-4">
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
                        @php $sc = $stageConfig[$stage]; $isSelected = old('stage', $deal->stage) === $stage; @endphp
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

            <div class="card mb-4">
                <div class="card-header py-3 px-4">
                    <i class="bi bi-link-45deg me-2" style="color:#fcd34d;"></i>Associations
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                        <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id">
                            <option value="" disabled>— Select a company —</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $deal->company_id) == $company->id ? 'selected' : '' }}>
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
                                <option value="{{ $contact->id }}" {{ old('contact_id', $deal->contact_id) == $contact->id ? 'selected' : '' }}>
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
                    <i class="bi bi-check-lg"></i> Save Changes
                </button>
                <a href="{{ route('deals.show', $deal) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header py-3 px-4">
                <i class="bi bi-clock-history me-2" style="color:#fcd34d;"></i>Record Info
            </div>
            <div class="card-body p-4">
                <dl class="mb-0" style="font-size:.83rem;">
                    <dt style="color:#475569;font-weight:500;text-transform:uppercase;font-size:.7rem;letter-spacing:.05em;">Created</dt>
                    <dd style="color:#94a3b8;" class="mb-3">{{ $deal->created_at->format('M d, Y') }}</dd>
                    <dt style="color:#475569;font-weight:500;text-transform:uppercase;font-size:.7rem;letter-spacing:.05em;">Last Updated</dt>
                    <dd style="color:#94a3b8;" class="mb-0">{{ $deal->updated_at->format('M d, Y') }}</dd>
                </dl>
            </div>
        </div>
        <div class="card" style="border-color:rgba(239,68,68,.2);">
            <div class="card-header py-3 px-4" style="border-color:rgba(239,68,68,.2);">
                <i class="bi bi-exclamation-triangle me-2" style="color:#f87171;"></i>
                <span style="color:#f87171;">Danger Zone</span>
            </div>
            <div class="card-body p-4">
                <p style="font-size:.8rem;color:#64748b;" class="mb-3">Permanently removes this deal from the system.</p>
                <form action="{{ route('deals.destroy', $deal) }}" method="POST"
                      onsubmit="return confirm('Delete deal \'{{ addslashes($deal->title) }}\'?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                        <i class="bi bi-trash3 me-1"></i> Delete Deal
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
