<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrera användare</title>
</head>
<body>
    <h2>Registrera dig</h2>
    <form method="POST" action="{{ url('/api/register') }}">
        @csrf
        <label for="name">Namn:</label>
        <input type="text" name="name" required><br>

        <label for="email">E-post:</label>
        <input type="email" name="email" required><br>

        <label for="password">Lösenord:</label>
        <input type="password" name="password" required><br>

        <label for="password_confirmation">Bekräfta lösenord:</label>
        <input type="password" name="password_confirmation" required><br>

        <button type="submit">Registrera</button>

        <a href="{{ route('auth.login') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Log In</a>
    </form>
</body>
</html>
