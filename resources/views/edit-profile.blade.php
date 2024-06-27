<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
    <title>Edit Profile</title>
</head>

<body>

    <section class="container">
        <header>Edit</header>
        <form action="{{ route('update-profile') }}" method="POST" class="form">
            @csrf
            <div class="input-box">
                <label>Email</label>
                <input type="email" placeholder="Enter email" required name="email" value="{{ $user->email }}" />
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Name</label>
                    <input type="text" placeholder="Enter password" required name="name" value="{{ $user->name }}" />
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="column">
                <div class="input-box">
                    <label>Password</label>
                    <input type="password" placeholder="Enter password" = name="password" />
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="column">
                <div class="input-box">
                    <label>New Password</label>
                    <input type="password" placeholder="Enter new password"  name="password_confirmation" />
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </section>
</body>

</html>