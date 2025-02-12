<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in</title>
</head>
<body>

    <h2>Log In</h2>

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <label for="email">E-post:</label>
        <input type="email" name="email" required><br>

        <label for="password">Lösenord:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Log In</button>

    </form>

    <a href="{{ route('auth.register') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Register</a>
    
</body>
</html>
