<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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
        .orb3 { width: 300px; height: 300px; background: #4f46e5; top: 50%; left: 50%; transform: translate(-50%,-50%); }

        .card {
            position: relative;
            width: 100%;
            max-width: 420px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
            animation: slideUp .6s cubic-bezier(.22,.68,0,1.2) both;
        }
        .card::before {
            content: '';
            position: absolute; inset: 0;
            border-radius: 24px; padding: 1px;
            background: linear-gradient(135deg, rgba(108,99,255,.4), transparent 60%, rgba(167,139,250,.2));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude;
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

        /* Session status (e.g. after password reset) */
        .alert-status {
            background: rgba(74,222,128,.08);
            border: 1px solid rgba(74,222,128,.25);
            border-radius: 12px;
            padding: .85rem 1rem;
            margin-bottom: 1.25rem;
            font-size: .82rem;
            color: #4ade80;
        }

        /* Validation error banner */
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
        /* Eye toggle sits on the right */
        .eye-toggle {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            left: auto;
            cursor: pointer;
            background: none; border: none; padding: 0;
            display: flex; align-items: center;
        }
        .eye-toggle svg { stroke: var(--muted); transition: stroke .2s; }
        .eye-toggle:hover svg { stroke: var(--accent2); }

        input {
            width: 100%;
            background: var(--surface2);
            border: 1.5px solid var(--border);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            padding: .75rem 2.6rem .75rem 2.6rem;
            border-radius: 12px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            -webkit-appearance: none;
        }
        input::placeholder { color: var(--muted); opacity: .6; }
        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(108,99,255,.15);
        }
        .input-wrap:focus-within > svg:first-of-type { stroke: var(--accent2); }
        input.is-invalid { border-color: var(--error) !important; }
        .invalid-feedback { font-size: .75rem; color: var(--error); margin-top: .3rem; display: block; }

        /* Remember + forgot row */
        .form-footer {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.4rem;
        }
        .remember {
            display: flex; align-items: center; gap: 8px;
            font-size: .82rem; color: var(--muted); cursor: pointer;
        }
        .remember input[type="checkbox"] {
            width: 15px; height: 15px; padding: 0;
            border-radius: 4px; accent-color: var(--accent);
            cursor: pointer;
        }
        .forgot { font-size: .82rem; color: var(--accent2); text-decoration: none; }
        .forgot:hover { text-decoration: underline; }

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

        .register-link {
            text-align: center; margin-top: 1.2rem;
            font-size: .83rem; color: var(--muted);
        }
        .register-link a { color: var(--accent2); text-decoration: none; font-weight: 500; }
        .register-link a:hover { text-decoration: underline; }
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

    <h1>Welcome back</h1>
    <p class="subtitle">Sign in to continue to your account.</p>

    {{-- Session status (e.g. "Password reset link sent") --}}
    @if (session('status'))
        <div class="alert-status">{{ session('status') }}</div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="field">
            <label for="email">Email address</label>
            <div class="input-wrap">
                <svg viewBox="0 0 24 24">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                </svg>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="juan@example.com"
                    autocomplete="email"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    required
                    autofocus
                >
            </div>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="field">
            <label for="password">Password</label>
            <div class="input-wrap">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Your password"
                    autocomplete="current-password"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    required
                >
                {{-- Show / hide password toggle --}}
                <button type="button" class="eye-toggle" onclick="togglePassword()" aria-label="Toggle password visibility">
                    <svg id="eye-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Remember me + Forgot password --}}
        <div class="form-footer">
            <label class="remember">
                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    {{ old('remember') ? 'checked' : '' }}
                >
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="btn">Sign in</button>
    </form>

    @if (Route::has('register'))
        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Create one</a>
        </div>
    @endif
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eye-icon');
    const show  = input.type === 'password';
    input.type  = show ? 'text' : 'password';
    icon.innerHTML = show
        ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
           <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
           <line x1="1" y1="1" x2="23" y2="23"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
           <circle cx="12" cy="12" r="3"/>`;
}
</script>

</body>
</html>