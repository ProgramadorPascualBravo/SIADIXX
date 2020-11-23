<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Suanfonson</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="
    display: flex;
    height: 100vh;
    width: 100vw;
    justify-content: center;
    align-items: center;
">
    <div class="container-login" style="
    width: 500px;
    padding: 1em;
    box-shadow: 0px 0px 10px black;
">
        <form action="{{ route('sing-in') }}" method="post">
            <div class="medium-12 cell">
                <label for="username">
                    Usuario<input type="email" name="username" id="username" required>
                </label>
                @error('username')
                    <span class="label alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="medium-12 cell">
                <label for="password">
                    Password
                    <input type="password" name="password" id="password" required>
                </label>
                @error('password')
                <span class="label alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="medium-12 cell">
                <button class="button">Ingresar</button>
            </div>
            @csrf
        </form>
    </div>
</body>
</html>
