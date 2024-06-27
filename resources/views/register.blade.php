<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/registration.css') }}" rel="stylesheet">
    <title>Register Form</title>
</head>
<body>
    <section class="container">
        <header>Registration Form</header>
        <form action="{{ route('register.add') }}" method="POST" class="form">
            @csrf
            <div class="input-box">
                <label>Email</label>
                <input type="email" placeholder="Enter email" required name="email" />
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <label>Full Name</label>
                <input type="text" placeholder="Enter full name" required name="name" />
                @error('name')
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
            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" checked value="Male" />
                        <label for="check-male">male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" value="Female" />
                        <label for="check-female">Female</label>
                    </div>
                </div>
                @error('gender')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Registration</button>
            <p style="color: #333;">Already have an account? <a href="{{ route('login.form') }}">Login here</a></p>
        </form>
    </section>
</body>

</html>