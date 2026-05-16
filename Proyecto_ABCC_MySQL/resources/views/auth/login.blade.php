<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABCC – Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0d1117;
            --panel:     #161b22;
            --border:    #30363d;
            --accent:    #e8c96d;
            --accent2:   #c0955a;
            --text:      #e6edf3;
            --muted:     #7d8590;
            --error:     #f85149;
            --radius:    12px;
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background-image:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(232,201,109,.12) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 110%, rgba(192,149,90,.10) 0%, transparent 55%);
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 48px 40px 40px;
            animation: fadeUp .5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px; height: 56px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent2) 100%);
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: #0d1117;
            font-weight: 700;
            margin-bottom: 14px;
            box-shadow: 0 4px 24px rgba(232,201,109,.25);
        }

        .logo h1 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            letter-spacing: .5px;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo p {
            font-size: 13px;
            color: var(--muted);
            margin-top: 4px;
            font-weight: 300;
        }

        .error-box {
            background: rgba(248,81,73,.1);
            border: 1px solid rgba(248,81,73,.35);
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 13.5px;
            color: var(--error);
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            margin-bottom: 6px;
            letter-spacing: .3px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 14.5px;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(232,201,109,.12);
        }

        input.is-invalid {
            border-color: var(--error);
        }

        .field-error {
            font-size: 12px;
            color: var(--error);
            margin-top: 5px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        input[type="checkbox"] {
            accent-color: var(--accent);
            width: 15px; height: 15px;
            cursor: pointer;
        }

        .remember-row label {
            margin: 0;
            font-size: 13.5px;
            color: var(--muted);
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent2) 100%);
            color: #0d1117;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            letter-spacing: .3px;
            transition: opacity .2s, transform .15s;
            box-shadow: 0 4px 20px rgba(232,201,109,.2);
        }

        .btn-login:hover  { opacity: .9; transform: translateY(-1px); }
        .btn-login:active { opacity: 1;  transform: translateY(0); }

        .divider {
            text-align: center;
            font-size: 12px;
            color: var(--border);
            margin: 22px 0 0;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="logo">
        <div class="logo-badge">AB</div>
        <h1>ABCC</h1>
        <p>Sistema de Gestión Académica</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="field">
            <label for="email">Correo electrónico</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="usuario@ejemplo.com"
                autocomplete="email"
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                required
                autofocus
            >
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="password">Contraseña</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                autocomplete="current-password"
                required
            >
        </div>

        <div class="remember-row">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Mantener sesión iniciada</label>
        </div>

        <button type="submit" class="btn-login">Ingresar al sistema</button>

        <p class="divider">ABCC · Sistema Académico</p>
    </form>
</div>

</body>
</html>