<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>

<a href="{{ route('auth.login') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Log In</a>

<a href="{{ route('auth.register') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Register</a>

<a href="{{ route('guest.chat') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Start chatting</a>

</body>
</html>