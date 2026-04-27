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
            {{-- Primary Nav — only shown to authenticated users --}}
            @auth
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
            @else
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            @endauth

            {{-- Right side --}}
            <div class="d-flex align-items-center gap-3">
                @auth
                    {{-- Quick Add --}}
                    <button class="btn btn-sm btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#quickAddModal">
                        <i class="bi bi-plus-lg"></i> Quick Add
                    </button>

                    {{-- User dropdown --}}
                    <div class="dropdown">
                        <button class="btn d-flex align-items-center gap-2 p-0 border-0 bg-transparent"
                                type="button"
                                id="userDropdown"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                aria-haspopup="true">
                            <div style="width:34px;height:34px;background:linear-gradient(135deg,#6366f1,#4f46e5);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.75rem;color:#fff;flex-shrink:0;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <span class="d-none d-sm-inline" style="color:rgba(255,255,255,.75);font-size:.875rem;font-weight:500;">{{ Auth::user()->name }}</span>
                            <i class="bi bi-chevron-down" style="color:#64748b;font-size:.65rem;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end mt-2"
                            aria-labelledby="userDropdown"
                            style="background:#1e293b;border:1px solid rgba(255,255,255,.08);min-width:210px;box-shadow:0 8px 32px rgba(0,0,0,.4);">

                            {{-- User info header --}}
                            <li>
                                <div class="px-3 py-2 d-flex align-items-center gap-2">
                                    <div style="width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#4f46e5);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.7rem;color:#fff;flex-shrink:0;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    </div>
                                    <div style="min-width:0;">
                                        <div class="fw-semibold text-truncate" style="color:#f1f5f9;font-size:.8rem;">{{ Auth::user()->name }}</div>
                                        <div class="text-truncate" style="color:#475569;font-size:.72rem;">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider my-1" style="border-color:rgba(255,255,255,.07);"></li>

                            {{-- Profile Settings --}}
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                   href="{{ route('profile') }}"
                                   style="color:#cbd5e1;font-size:.85rem;">
                                    <i class="bi bi-person-circle" style="color:#818cf8;width:16px;text-align:center;"></i>
                                    Profile Settings
                                </a>
                            </li>

                            {{-- System Settings --}}
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                   href="#"
                                   style="color:#cbd5e1;font-size:.85rem;">
                                    <i class="bi bi-gear" style="color:#64748b;width:16px;text-align:center;"></i>
                                    System Settings
                                </a>
                            </li>

                            <li><hr class="dropdown-divider my-1" style="border-color:rgba(255,255,255,.07);"></li>

                            {{-- Logout --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-item d-flex align-items-center gap-2 py-2"
                                            style="color:#f87171;font-size:.85rem;">
                                        <i class="bi bi-box-arrow-right" style="width:16px;text-align:center;"></i>
                                        Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- Guest links --}}
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Log In
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-person-plus me-1"></i> Register
                    </a>
                @endauth
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
