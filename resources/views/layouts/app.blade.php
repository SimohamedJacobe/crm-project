<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Professional CRM — Manage your companies, contacts, and deals.">
    <title>@yield('title', 'Dashboard') — CRM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/scss/app.scss', 'resources/ts/app.ts'])
</head>
<body>

{{-- ==================== NAVBAR ==================== --}}
<nav class="navbar navbar-expand-lg navbar-crm sticky-top">
    <div class="container-xl">

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <div style="width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#818cf8);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-diagram-3-fill text-white" style="font-size:.95rem;"></i>
            </div>
            <span>Nexus<span class="text-primary">CRM</span></span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            {{-- Primary Nav --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-speedometer2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('companies*') ? 'active' : '' }}" href="{{ route('companies.index') }}">
                        <i class="bi bi-buildings"></i>Companies
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contacts*') ? 'active' : '' }}" href="{{ route('contacts.index') }}">
                        <i class="bi bi-person-lines-fill"></i>Contacts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('deals*') ? 'active' : '' }}" href="{{ route('deals.index') }}">
                        <i class="bi bi-briefcase"></i>Deals
                    </a>
                </li>
            </ul>

            {{-- Right side --}}
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#quickAddModal">
                    <i class="bi bi-plus-lg"></i> Quick Add
                </button>
                <div class="d-flex align-items-center gap-2" style="cursor:pointer;">
                    <div style="width:34px;height:34px;background:linear-gradient(135deg,#334155,#475569);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-person-fill text-slate" style="color:#94a3b8;font-size:.9rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- ==================== MAIN CONTENT ==================== --}}
<main class="container-xl py-4">

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible d-flex align-items-center gap-2 mb-4 fade show" role="alert">
            <i class="bi bi-check-circle-fill flex-shrink-0"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2 mb-4 fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

{{-- ==================== QUICK ADD MODAL ==================== --}}
<div class="modal fade" id="quickAddModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#1e293b;border:1px solid rgba(255,255,255,.07);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold text-light">Quick Add</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-3">
                <div class="d-grid gap-2">
                    <a href="{{ route('companies.create') }}" class="btn btn-outline-secondary text-start d-flex align-items-center gap-3 p-3">
                        <div style="width:36px;height:36px;background:rgba(99,102,241,.15);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-buildings" style="color:#818cf8;"></i>
                        </div>
                        <div>
                            <div class="fw-semibold text-light">New Company</div>
                            <div class="text-muted" style="font-size:.78rem;">Add a company to your CRM</div>
                        </div>
                    </a>
                    <a href="{{ route('contacts.create') }}" class="btn btn-outline-secondary text-start d-flex align-items-center gap-3 p-3">
                        <div style="width:36px;height:36px;background:rgba(34,197,94,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person-plus" style="color:#86efac;"></i>
                        </div>
                        <div>
                            <div class="fw-semibold text-light">New Contact</div>
                            <div class="text-muted" style="font-size:.78rem;">Add a person to your CRM</div>
                        </div>
                    </a>
                    <a href="{{ route('deals.create') }}" class="btn btn-outline-secondary text-start d-flex align-items-center gap-3 p-3">
                        <div style="width:36px;height:36px;background:rgba(245,158,11,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-briefcase" style="color:#fcd34d;"></i>
                        </div>
                        <div>
                            <div class="fw-semibold text-light">New Deal</div>
                            <div class="text-muted" style="font-size:.78rem;">Track a new opportunity</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ==================== FOOTER ==================== --}}
<footer class="mt-auto py-3 text-center" style="border-top:1px solid rgba(255,255,255,.05);">
    <span style="font-size:.78rem;color:#334155;">© {{ date('Y') }} NexusCRM — All rights reserved.</span>
</footer>

@stack('scripts')
</body>
</html>
