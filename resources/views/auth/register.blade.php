<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0a0a0f;
            --surface: #13131a;
            --surface2: #1c1c26;
            --accent: #6c63ff;
            --accent2: #a78bfa;
            --text: #f0eeff;
            --muted: #6b6a7e;
            --border: #2a2938;
            --error: #ff6b6b;
            --success: #4ade80;
        }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow: hidden;
            position: relative;
        }
        .bg-orb { position: fixed; border-radius: 50%; filter: blur(80px); opacity: 0.18; pointer-events: none; }
        .orb1 { width: 500px; height: 500px; background: #6c63ff; top: -100px; right: -100px; }
        .orb2 { width: 400px; height: 400px; background: #a78bfa; bottom: -100px; left: -100px; }
        .orb3 { width: 300px; height: 300px; background: #4f46e5; top: 50%; left: 50%; transform: translate(-50%, -50%); }

        .card {
            position: relative;
            width: 100%;
            max-width: 460px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
            animation: slideUp .6s cubic-bezier(.22,.68,0,1.2) both;
        }
        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 24px;
            padding: 1px;
            background: linear-gradient(135deg, rgba(108,99,255,.4), transparent 60%, rgba(167,139,250,.2));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .brand { display: flex; align-items: center; gap: 10px; margin-bottom: 2rem; }
        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .brand-icon svg { width: 20px; height: 20px; fill: none; stroke: white; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .brand-name { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1.1rem; color: var(--text); }

        h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.75rem; font-weight: 800;
            line-height: 1.15; letter-spacing: -.03em;
            margin-bottom: .4rem;
            background: linear-gradient(135deg, #f0eeff, #a78bfa);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .subtitle { color: var(--muted); font-size: .875rem; font-weight: 300; margin-bottom: 2rem; }

        /* Laravel validation error banner */
        .alert-errors {
            background: rgba(255,107,107,.08);
            border: 1px solid rgba(255,107,107,.25);
            border-radius: 12px;
            padding: .85rem 1rem;
            margin-bottom: 1.25rem;
            font-size: .82rem;
            color: var(--error);
            line-height: 1.6;
        }
        .alert-errors ul { padding-left: 1.2rem; }

        .row { display: flex; gap: 12px; }
        .row .field { flex: 1; }

        .field { margin-bottom: 1.1rem; }

        label {
            display: block;
            font-size: .78rem; font-weight: 500;
            color: var(--muted);
            text-transform: uppercase; letter-spacing: .08em;
            margin-bottom: .45rem;
        }
        .input-wrap { position: relative; }
        .input-wrap svg {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            width: 16px; height: 16px;
            stroke: var(--muted); fill: none; stroke-width: 1.8;
            pointer-events: none; transition: stroke .2s;
        }
        input, select {
            width: 100%;
            background: var(--surface2);
            border: 1.5px solid var(--border);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            padding: .75rem 1rem .75rem 2.6rem;
            border-radius: 12px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            -webkit-appearance: none;
        }
        input::placeholder { color: var(--muted); opacity: .6; }
        input:focus, select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(108,99,255,.15);
        }
        input:focus ~ svg, select:focus ~ svg,
        .input-wrap:focus-within svg { stroke: var(--accent2); }
        input.is-invalid { border-color: var(--error) !important; }
        .invalid-feedback {
            font-size: .75rem; color: var(--error);
            margin-top: .3rem; display: block;
        }

        .terms {
            display: flex; align-items: flex-start; gap: 10px;
            font-size: .8rem; color: var(--muted);
            margin-bottom: 1.4rem; line-height: 1.5;
        }
        .terms input[type="checkbox"] {
            width: 16px; height: 16px; min-width: 16px;
            padding: 0; border-radius: 5px;
            accent-color: var(--accent);
            cursor: pointer; margin-top: 1px;
        }
        .terms a { color: var(--accent2); text-decoration: none; }
        .terms a:hover { text-decoration: underline; }

        .btn {
            width: 100%; padding: .85rem;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: .95rem; font-weight: 600; letter-spacing: .02em;
            border: none; border-radius: 12px;
            cursor: pointer; position: relative; overflow: hidden;
            transition: transform .15s, box-shadow .2s;
        }
        .btn::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.12), transparent);
            opacity: 0; transition: opacity .2s;
        }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 8px 24px rgba(108,99,255,.35); }
        .btn:hover::before { opacity: 1; }
        .btn:active { transform: translateY(0); }

        .login-link { text-align: center; margin-top: 1.2rem; font-size: .83rem; color: var(--muted); }
        .login-link a { color: var(--accent2); text-decoration: none; font-weight: 500; }
        .login-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="bg-orb orb1"></div>
<div class="bg-orb orb2"></div>
<div class="bg-orb orb3"></div>

<div class="card">
    <div class="brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <span class="brand-name">LaraBase</span>
    </div>

    <h1>Create account</h1>
    <p class="subtitle">Join us today — it's completely free.</p>

    {{-- Laravel validation error summary --}}
    @if ($errors->any())
        <div class="alert-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name row --}}
        <div class="row">
            <div class="field">
                <label for="fname">First name</label>
                <div class="input-wrap">
                    <input
                        type="text"
                        id="fname"
                        name="fname"
                        value="{{ old('fname') }}"
                        placeholder="Juan"
                        autocomplete="given-name"
                        class="{{ $errors->has('fname') ? 'is-invalid' : '' }}"
                        required
                    >
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                @error('fname')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="lname">Last name</label>
                <div class="input-wrap">
                    <input
                        type="text"
                        id="lname"
                        name="lname"
                        value="{{ old('lname') }}"
                        placeholder="dela Cruz"
                        autocomplete="family-name"
                        class="{{ $errors->has('lname') ? 'is-invalid' : '' }}"
                        required
                    >
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                @error('lname')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Email --}}
        <div class="field">
            <label for="email">Email address</label>
            <div class="input-wrap">
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="juan@example.com"
                    autocomplete="email"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    required
                >
                <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </div>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="field">
            <label for="password">Password</label>
            <div class="input-wrap">
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Min. 8 characters"
                    autocomplete="new-password"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    required
                >
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Confirm password --}}
        <div class="field">
            <label for="password_confirmation">Confirm password</label>
            <div class="input-wrap">
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repeat your password"
                    autocomplete="new-password"
                    required
                >
                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
        </div>

        {{-- Terms --}}
        <div class="terms">
            <input
                type="checkbox"
                id="terms"
                name="terms"
                {{ old('terms') ? 'checked' : '' }}
            >
            <label for="terms" style="text-transform:none;letter-spacing:0;cursor:pointer;">
                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
            </label>
        </div>
        @error('terms')
            <span class="invalid-feedback" style="margin-top:-.8rem;margin-bottom:.8rem;display:block;">{{ $message }}</span>
        @enderror

        <button type="submit" class="btn">
            Create account
        </button>
    </form>

    
</div>

</body>
</html>