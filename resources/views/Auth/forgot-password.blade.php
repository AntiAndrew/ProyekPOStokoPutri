<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
</head>
<body>
<h2>Reset Password</h2>
@if (session('status'))
    <p>{{ session('status') }}</p>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <button type="submit">Kirim Link Reset</button>
</form>
</body>
</html>
