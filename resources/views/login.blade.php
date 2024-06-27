<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Login Form</title>
</head>

<body>
    <section class="container">
        <header>Login Form</header>
        <form action="{{ route('login.add') }}" method="POST" class="form">
            @csrf
            <div class="input-box">
                <label>Email</label>
                <input type="email" placeholder="Enter email" required name="email" />
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Password</label>
                    <input type="password" placeholder="Enter password" required name="password" />
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit">Login</button>
            <p style="color: #333;">Don't have an account? <a href="{{ route('register.form') }}">Register here</a></p>
        </form>
    </section>
</body>

</html>