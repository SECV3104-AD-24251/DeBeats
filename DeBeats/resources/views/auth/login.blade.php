<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Link to login.css -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h3 class="login-title">Welcome Back</h3>
            <p class="login-subtitle">Please login to your account</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- UTM ID Field -->
                <div class="form-group">
                    <label for="UTMID" class="form-label">UTM ID</label>
                    <input
                        type="text"
                        id="UTMID"
                        name="UTMID"
                        class="form-input"
                        value="{{ old('UTMID') }}"
                        placeholder="Enter your UTM ID"
                        required
                    />
                    @error('UTMID')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field with Show/Hide Toggle Inside -->
                <div class="form-group password-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                            placeholder="Enter your password"
                            required
                        />
                        <span id="togglePassword" class="password-toggle">Show</span>
                    </div>
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="form-button">Login</button>

                <!-- General Errors -->
                @if ($errors->any())
                    <div class="form-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        // Show/Hide Password Functionality
        document.addEventListener('DOMContentLoaded', () => {
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');

            togglePassword.addEventListener('click', () => {
                const type =
                    passwordField.getAttribute('type') === 'password'
                        ? 'text'
                        : 'password';
                passwordField.setAttribute('type', type);
                togglePassword.textContent = type === 'password' ? 'Show' : 'Hide';
            });
        });
    </script>
</body>
</html>
