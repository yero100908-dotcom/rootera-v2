<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin – ROOTERA</title>
    <meta name="robots" content="noindex,nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body{background:linear-gradient(135deg,#0A2E78,#169F81);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem}
        .login-card{background:#fff;border-radius:24px;padding:3rem 2.5rem;width:100%;max-width:420px;box-shadow:0 24px 64px rgba(10,46,120,.3)}
        .login-logo{font-family:'Plus Jakarta Sans',sans-serif;font-size:2rem;font-weight:800;text-align:center;margin-bottom:.25rem}
        .login-sub{text-align:center;color:#6b7280;font-size:.9rem;margin-bottom:2rem}
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <span class="logo-root">ROOT</span><span class="logo-era">ERA</span>
        </div>
        <p class="login-sub">Panel Administrasi</p>

        @if($errors->any())
        <div class="alert alert-error" style="margin-bottom:1.5rem">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            {{ $errors->first() }}
        </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@rootera.id" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.5rem">
                <input type="checkbox" id="remember" name="remember" style="width:16px;height:16px;accent-color:#169F81">
                <label for="remember" style="font-size:.88rem;color:#4b5563;cursor:pointer">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:.9rem">
                Masuk ke Admin Panel
            </button>
        </form>
        <p style="text-align:center;margin-top:1.5rem;font-size:.85rem;color:#9ca3af">
            <a href="{{ route('home') }}" style="color:#169F81;font-weight:600">← Kembali ke Website</a>
        </p>
    </div>
</body>
</html>
