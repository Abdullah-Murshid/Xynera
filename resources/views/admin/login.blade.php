<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xynera Admin - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD@400,0,0&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0c10;
            --surface: #161b22;
            --primary: #ec5b13;
            --text: #f1f5f9;
            --text-muted: #8b949e;
            --stroke: rgba(255, 255, 255, 0.08);
            --error: #ef4444;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Public Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .login-card {
            background: var(--surface);
            padding: 2.5rem;
            border-radius: 1rem;
            border: 1px solid var(--stroke);
            width: 100%;
            max-width: 400px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--text);
        }

        .brand span { color: var(--primary); }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        input {
            width: 100%;
            padding: 0.75rem;
            background: rgba(13, 14, 18, 0.5);
            border: 1px solid var(--stroke);
            border-radius: 0.5rem;
            color: var(--text);
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus {
            border-color: var(--primary);
        }

        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-primary:hover { opacity: 0.9; }

        .error-message {
            color: var(--error);
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
            <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Xynera') }}" style="height: 32px; width: auto; object-fit: contain;">    
        </div>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password') <div class="error-message">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn-primary">Sign In</button>
        </form>
    </div>
</body>
</html>
