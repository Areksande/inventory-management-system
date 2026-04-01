<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — LaraBase</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0a0a0f;
            --surface: #13131a;
            --surface2: #1c1c26;
            --surface3: #22222e;
            --accent: #6c63ff;
            --accent2: #a78bfa;
            --text: #f0eeff;
            --muted: #6b6a7e;
            --border: #2a2938;
            --success: #4ade80;
            --warning: #fbbf24;
            --danger: #f87171;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 10;
        }
        .brand {
            display: flex; align-items: center; gap: 10px;
            padding: .5rem .75rem;
            margin-bottom: 2rem;
        }
        .brand-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .brand-icon svg { width: 18px; height: 18px; fill: none; stroke: white; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .brand-name { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1rem; }

        .nav-label {
            font-size: .65rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: .1em;
            color: var(--muted);
            padding: 0 .75rem;
            margin-bottom: .5rem;
        }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: .6rem .75rem;
            border-radius: 10px;
            font-size: .875rem;
            color: var(--muted);
            text-decoration: none;
            transition: background .15s, color .15s;
            margin-bottom: 2px;
            cursor: pointer;
        }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
        .nav-item:hover { background: var(--surface2); color: var(--text); }
        .nav-item.active { background: rgba(108,99,255,.15); color: var(--accent2); }
        .nav-item.active svg { color: var(--accent); }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid var(--border);
            padding-top: 1rem;
        }
        .user-pill {
            display: flex; align-items: center; gap: 10px;
            padding: .6rem .75rem;
            border-radius: 10px;
        }
        .avatar {
            width: 30px; height: 30px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: .7rem; font-weight: 700;
            color: white; flex-shrink: 0;
        }
        .user-info { flex: 1; min-width: 0; }
        .user-name { font-size: .8rem; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: .7rem; color: var(--muted); }

        /* ── Main content ── */
        .main {
            margin-left: 240px;
            flex: 1;
            padding: 2rem 2.5rem;
            min-height: 100vh;
        }

        /* ── Top bar ── */
        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 2rem;
            animation: fadeDown .5s ease both;
        }
        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem; font-weight: 800;
            letter-spacing: -.02em;
        }
        .page-sub { color: var(--muted); font-size: .85rem; margin-top: .15rem; }

        .topbar-actions { display: flex; align-items: center; gap: .75rem; }
        .btn-outline {
            display: flex; align-items: center; gap: 6px;
            padding: .5rem 1rem;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: .82rem;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: border-color .15s, color .15s;
        }
        .btn-outline svg { width: 14px; height: 14px; }
        .btn-outline:hover { border-color: var(--accent); color: var(--accent2); }

        /* ── Stat cards ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            position: relative;
            overflow: hidden;
            animation: fadeUp .5s ease both;
        }
        .stat-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            opacity: 0;
            transition: opacity .2s;
        }
        .stat-card:hover::before { opacity: 1; }
        .stat-card:nth-child(2) { animation-delay: .05s; }
        .stat-card:nth-child(3) { animation-delay: .1s; }

        .stat-label {
            font-size: .75rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: .08em;
            color: var(--muted);
            margin-bottom: .6rem;
            display: flex; align-items: center; gap: 6px;
        }
        .stat-label svg { width: 13px; height: 13px; }
        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 2rem; font-weight: 800;
            letter-spacing: -.03em;
            line-height: 1;
            margin-bottom: .3rem;
        }
        .stat-change {
            font-size: .75rem; color: var(--success);
            display: flex; align-items: center; gap: 4px;
        }
        .stat-change.down { color: var(--danger); }
        .stat-change svg { width: 12px; height: 12px; }

        /* ── Table section ── */
        .section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            animation: fadeUp .5s .15s ease both;
        }
        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem; font-weight: 700;
        }
        .section-sub { font-size: .78rem; color: var(--muted); margin-top: .1rem; }

        .search-wrap {
            position: relative;
            display: flex; align-items: center;
        }
        .search-wrap svg {
            position: absolute; left: 10px;
            width: 14px; height: 14px;
            color: var(--muted); pointer-events: none;
        }
        .search-input {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: .82rem;
            padding: .45rem .75rem .45rem 2rem;
            border-radius: 8px;
            outline: none;
            width: 200px;
            transition: border-color .2s;
        }
        .search-input::placeholder { color: var(--muted); opacity: .6; }
        .search-input:focus { border-color: var(--accent); }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            padding: .75rem 1.5rem;
            font-size: .7rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: .08em;
            color: var(--muted);
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .12s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--surface2); }
        tbody td {
            padding: .9rem 1.5rem;
            font-size: .875rem;
            vertical-align: middle;
        }

        .user-cell { display: flex; align-items: center; gap: 10px; }
        .table-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: .68rem; font-weight: 700;
            color: white; flex-shrink: 0;
        }
        .table-name { font-weight: 500; font-size: .875rem; }
        .table-email { font-size: .75rem; color: var(--muted); margin-top: 1px; }

        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: .25rem .65rem;
            border-radius: 20px;
            font-size: .72rem; font-weight: 500;
        }
        .badge-dot { width: 5px; height: 5px; border-radius: 50%; }
        .badge-active {
            background: rgba(74,222,128,.1);
            color: var(--success);
        }
        .badge-active .badge-dot { background: var(--success); }
        .badge-inactive {
            background: rgba(107,106,126,.1);
            color: var(--muted);
        }
        .badge-inactive .badge-dot { background: var(--muted); }

        .action-btn {
            background: none; border: none;
            color: var(--muted); cursor: pointer;
            padding: .35rem;
            border-radius: 6px;
            transition: background .12s, color .12s;
            display: inline-flex; align-items: center;
        }
        .action-btn:hover { background: var(--surface3); color: var(--text); }
        .action-btn svg { width: 14px; height: 14px; }

        /* ── Empty state ── */
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: var(--muted);
        }
        .empty-icon {
            width: 48px; height: 48px;
            background: var(--surface2);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .empty-icon svg { width: 22px; height: 22px; color: var(--muted); }
        .empty-title { font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 600; color: var(--text); margin-bottom: .35rem; }
        .empty-sub { font-size: .83rem; }

        /* ── Pagination ── */
        .table-footer {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
            font-size: .8rem; color: var(--muted);
        }
        .pagination { display: flex; gap: 4px; }
        .page-btn {
            width: 30px; height: 30px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 7px;
            border: 1px solid var(--border);
            background: none;
            color: var(--muted);
            font-size: .8rem;
            cursor: pointer;
            transition: all .12s;
            font-family: 'DM Sans', sans-serif;
        }
        .page-btn:hover { border-color: var(--accent); color: var(--accent2); }
        .page-btn.active { background: var(--accent); border-color: var(--accent); color: white; }
        .page-btn svg { width: 12px; height: 12px; }

        /* ── Logout form ── */
        .logout-form { display: contents; }

        /* ── Animations ── */
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 1.25rem; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

{{-- ── Sidebar ── --}}
<aside class="sidebar">
    <div class="brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <span class="brand-name">LaraBase</span>
    </div>

    <div class="nav-label">Main</div>
    <a href="{{ url('/dashboard') }}" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        Dashboard
    </a>
    <a href="#" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        Users
    </a>
    <a href="#" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
        </svg>
        Reports
    </a>

    <div class="nav-label" style="margin-top:1.5rem">Settings</div>
    <a href="#" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.07 4.93A10 10 0 0 0 4.93 19.07M19.07 4.93l-1.41 1.41M4.93 19.07l1.41-1.41"/>
        </svg>
        Settings
    </a>

    <div class="sidebar-footer">
        <div class="user-pill">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="nav-item" style="width:100%;background:none;border:none;text-align:left;cursor:pointer;color:var(--muted);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Sign out
            </button>
        </form>
    </div>
</aside>

{{-- ── Main ── --}}
<main class="main">

    {{-- Top bar --}}
    <div class="topbar">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-sub">{{ now()->format('l, F j Y') }}</p>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('register') }}" class="btn-outline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add user
            </a>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                Total users
            </div>
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-change">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
                All registered accounts
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                New this month
            </div>
            <div class="stat-value">{{ $newThisMonth }}</div>
            <div class="stat-change">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
                Since {{ now()->startOfMonth()->format('M 1') }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                New today
            </div>
            <div class="stat-value">{{ $newToday }}</div>
            <div class="stat-change">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
                Registered today
            </div>
        </div>
    </div>

    {{-- Users table --}}
    <div class="section">
        <div class="section-header">
            <div>
                <div class="section-title">Registered users</div>
                <div class="section-sub">{{ $users->total() }} users total</div>
            </div>
            <div class="search-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <form method="GET" action="{{ url('/dashboard') }}">
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        placeholder="Search users…"
                        value="{{ request('search') }}"
                        onchange="this.form.submit()"
                    >
                </form>
            </div>
        </div>

        <div class="table-wrap">
            @if($users->count())
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Joined</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    @php
                        $colors = ['#6c63ff','#a78bfa','#4ade80','#fbbf24','#f87171','#38bdf8','#fb923c'];
                        $color  = $colors[$user->id % count($colors)];
                        $initials = strtoupper(substr($user->name, 0, 1) . (str_contains($user->name, ' ') ? substr(strrchr($user->name, ' '), 1, 1) : ''));
                    @endphp
                    <tr>
                        <td style="color:var(--muted);font-size:.78rem;">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="table-avatar" style="background: white;">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <div class="table-name">{{ $user->name }}</div>
                                    <div class="table-email">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="color:var(--muted);font-size:.82rem;">
                            {{ $user->created_at->format('M j, Y') }}<br>
                            <span style="font-size:.73rem;">{{ $user->created_at->diffForHumans() }}</span>
                        </td>
                        <td>
                            <span class="badge badge-active">
                                <span class="badge-dot"></span>
                                Active
                            </span>
                        </td>
                        <td>
                            <button class="action-btn" title="View user">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <div class="empty-title">No users found</div>
                <div class="empty-sub">
                    @if(request('search'))
                        No results for "{{ request('search') }}"
                    @else
                        No users have registered yet.
                    @endif
                </div>
            </div>
            @endif
        </div>

        @if($users->count())
        <div class="table-footer">
            <span>Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }}</span>
            <div class="pagination">
                @if($users->onFirstPage())
                    <button class="page-btn" disabled>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                @else
                    <a href="{{ $users->previousPageUrl() }}" class="page-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </a>
                @endif

                @for($p = max(1, $users->currentPage() - 2); $p <= min($users->lastPage(), $users->currentPage() + 2); $p++)
                    <a href="{{ $users->url($p) }}" class="page-btn {{ $p === $users->currentPage() ? 'active' : '' }}">{{ $p }}</a>
                @endfor

                @if($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="page-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                @else
                    <button class="page-btn" disabled>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                @endif
            </div>
        </div>
        @endif
    </div>

</main>

</body>
</html>