@extends('layouts.app')
@section('head')
    <script>
        window.allowGuestPage = true;
    </script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --poll-gradient: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 50%, #45b7d1 100%);
            --success-gradient: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.25);
            --input-glass: rgba(255, 255, 255, 0.1);
            --text-primary: #2c3e50;
            --card-shadow: 0 15px 35px rgba(31, 38, 135, 0.37);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #ff6b6b 50%, #4ecdc4 75%, #45b7d1 100%);
            background-size: 400% 400%;
            animation: gradientFlow 20s ease infinite;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradientFlow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Floating particles background */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite;
        }

        .particle:nth-child(odd) {
            animation-direction: reverse;
            background: rgba(255, 107, 107, 0.1);
        }

        .particle:nth-child(3n) {
            background: rgba(78, 205, 196, 0.1);
        }

        .particle:nth-child(4n) {
            background: rgba(69, 183, 209, 0.1);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-50px) rotate(120deg);
            }

            66% {
                transform: translateY(-100px) rotate(240deg);
            }
        }

        /* Container positioning */
        .container {
            position: relative;
            z-index: 2;
        }

        /* Login card styling */
        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: slideInUp 0.8s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(31, 38, 135, 0.5);
        }

        /* Header styling */
        .login-header {
            background: var(--poll-gradient);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
        }

        .login-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            margin: 0;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.9);
            margin-top: 0.5rem;
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }

        .login-icon {
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
            animation: iconBounce 2s infinite;
        }

        @keyframes iconBounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        /* Form body styling */
        .login-body {
            padding: 2.5rem;
        }

        /* Form controls */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            color: white;
            font-weight: 600;
            margin-bottom: 0.8rem;
            display: block;
            font-size: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .form-control-glass {
            background: var(--input-glass);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 1rem 1.2rem;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-control-glass::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-control-glass:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Input icons */
        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.1rem;
            pointer-events: none;
        }

        .input-wrapper {
            position: relative;
        }

        /* Submit button */
        .btn-login {
            background: var(--poll-gradient);
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1rem;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        /* Error message styling */
        .error-message {
            background: rgba(255, 107, 107, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 107, 107, 0.3);
            border-radius: 10px;
            padding: 0.8rem 1rem;
            color: #ff6b6b;
            font-weight: 600;
            margin-bottom: 1rem;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        /* Register link */
        .register-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .register-link p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        .register-link a {
            color: white;
            text-decoration: none;
            font-weight: 700;
            background: var(--poll-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
            position: relative;
        }

        .register-link a:hover {
            transform: translateY(-2px);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--poll-gradient);
            transition: width 0.3s ease;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        /* Loading state */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .login-card {
                margin: 1rem;
                border-radius: 20px;
            }

            .login-header {
                padding: 1.5rem;
            }

            .login-title {
                font-size: 1.8rem;
            }

            .login-body {
                padding: 2rem 1.5rem;
            }

            .login-icon {
                font-size: 2.5rem;
            }
        }

        /* Welcome message */
        .welcome-message {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .welcome-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            line-height: 1.6;
        }
    </style>
@endsection

@section('content')
    <!-- Floating Particles Background -->
    <div class="particles" id="particles"></div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card shadow rounded-3">
                    <div class="login-header">
                        <div class="login-icon">
                            <i class="fas fa-vote-yea"></i>
                        </div>
                        <h2 class="login-title">Welcome Back</h2>
                        <p class="login-subtitle">Sign in to continue to PollsMaster</p>
                    </div>

                    <div class="login-body">
                        <div class="welcome-message">
                            <p class="welcome-text">
                                <i class="fas fa-poll me-2"></i>
                                Ready to create and participate in exciting polls?
                            </p>
                        </div>

                        <form id="loginForm">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email Address
                                </label>
                                <div class="input-wrapper">
                                    <input type="email" name="email" class="form-control form-control-glass"
                                        placeholder="Enter your email address" required />
                                    <i class="fas fa-at input-icon"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" name="password" class="form-control form-control-glass"
                                        placeholder="Enter your password" required />
                                    <i class="fas fa-key input-icon"></i>
                                </div>
                            </div>

                            <div id="login-error" class="error-message d-none"></div>

                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Sign In
                            </button>

                            <div class="register-link">
                                <p>
                                    Don't have an account?
                                    <a href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>Create Account
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 40;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                // Random size between 8px and 20px
                const size = Math.random() * 12 + 8;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';

                // Random animation duration
                particle.style.animationDuration = (Math.random() * 8 + 8) + 's';
                particle.style.animationDelay = Math.random() * 4 + 's';

                particlesContainer.appendChild(particle);
            }
        }

        $(document).ready(function() {
            // Initialize particles
            createParticles();

            // Redirect to dashboard if token already exists
            if (localStorage.getItem('access_token')) {
                window.location.href = '/dashboard';
            }

            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default behavior

                const $errorDiv = $('#login-error');
                const $submitBtn = $(this).find('button[type="submit"]');

                // Clear previous errors
                $errorDiv.addClass('d-none').text('');

                // Add loading state
                $submitBtn.addClass('btn-loading').prop('disabled', true);

                const form = $(this);
                const data = form.serialize();

                $.ajax({
                    url: '/api/login',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        localStorage.setItem('access_token', response.access_token);

                        // Success feedback
                        $submitBtn.removeClass('btn-loading').html(
                            '<i class="fas fa-check me-2"></i>Success!');

                        setTimeout(() => {
                            window.location.href = '/dashboard';
                        }, 500);
                    },
                    error: function(xhr) {
                        let message = 'Login failed. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        // Show error
                        $errorDiv.removeClass('d-none').html(
                            '<i class="fas fa-exclamation-triangle me-2"></i>' + message);

                        // Remove loading state
                        $submitBtn.removeClass('btn-loading btn-loading').prop('disabled',
                                false)
                            .html('<i class="fas fa-sign-in-alt me-2"></i>Sign In');
                    }
                });
            });

            // Add input focus effects
            $('.form-control-glass').on('focus', function() {
                $(this).closest('.form-group').find('.form-label').css('color', '#ffffff');
            });

            $('.form-control-glass').on('blur', function() {
                $(this).closest('.form-group').find('.form-label').css('color', 'rgba(255, 255, 255, 0.9)');
            });
        });
    </script>
@endpush
