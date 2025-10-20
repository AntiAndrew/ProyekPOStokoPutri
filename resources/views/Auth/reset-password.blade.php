<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h2>Reset Password</h2>

@if (session('status'))
    <p>{{ session('status') }}</p>
@endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password Baru:</label>
    <input type="password" name="password" required><br>

    <label>Konfirmasi Password:</label>
    <input type="password" name="password_confirmation" required><br>

    <button type="submit">Ubah Password</button>
</form>
</body>
</html>
