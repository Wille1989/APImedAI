<!-- resources/views/guest/chat.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with AI</title>
</head>
<body>
    <h2>Chat with AI</h2>

    @if($errors->has('message'))
    <div style="color: red;">
        {{ $errors->first('message') }}
    </div>
    @endif

    <form action="{{ route('guest.chat.send') }}" method="POST">
        @csrf
        <div>
            <label for="message">Your Message:</label>
            <textarea name="message" id="message" rows="4" required></textarea>
        </div>
        <button type="submit">Send</button>
    </form>

    @if (session('response'))
    <div>
        <h4>AI Response:</h4>
        <p>{{ session('response') }}</p>
    </div>
    @endif
</body>
</html>
