<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <label>ID:</label>
    <input type="id" name="id" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>
<a href="{{ route('register') }}">Belum punya akun?</a>
<a href="{{ route('password.request') }}">Lupa password?</a>
</body>
</html>
