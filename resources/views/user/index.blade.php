<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index.User</title>
</head>

<body>
    
    @if(session('message'))

        <p style="color: green;">{{ session('message') }}</p>

    @endif

</body>
</html>