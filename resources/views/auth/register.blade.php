@extends('layouts.app')

@section('head')
    {{-- Allow guest access explicitly --}}
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

        /* Register card styling - Same as login */
        .register-card {
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

        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(31, 38, 135, 0.5);
        }

        /* Header styling - Same as login */
        .register-header {
            background: var(--poll-gradient);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
        }

        .register-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            margin: 0;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .register-subtitle {
            color: rgba(255, 255, 255, 0.9);
            margin-top: 0.5rem;
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }

        .register-icon {
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

        /* Form body styling - Same as login */
        .register-body {
            padding: 2.5rem;
        }

        /* Form controls - Same as login */
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

        /* Input icons - Same as login */
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

        /* Submit button - Same as login but green */
        .btn-register {
            background: var(--success-gradient);
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

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        /* Error message styling - Same as login */
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

        /* Login link - Same styling as register link in login */
        .login-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-link p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        .login-link a {
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

        .login-link a:hover {
            transform: translateY(-2px);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .login-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--poll-gradient);
            transition: width 0.3s ease;
        }

        .login-link a:hover::after {
            width: 100%;
        }

        /* Loading state - Same as login */
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

        /* Responsive design - Same as login */
        @media (max-width: 768px) {
            .register-card {
                margin: 1rem;
                border-radius: 20px;
            }

            .register-header {
                padding: 1.5rem;
            }

            .register-title {
                font-size: 1.8rem;
            }

            .register-body {
                padding: 2rem 1.5rem;
            }

            .register-icon {
                font-size: 2.5rem;
            }
        }

        /* Welcome message - Same as login */
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
                <div class="card register-card shadow rounded-3">
                    <div class="register-header">
                        <div class="register-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h2 class="register-title">Join PollsMaster</h2>
                        <p class="register-subtitle">Create your account to start polling</p>
                    </div>

                    <div class="register-body">
                        <div class="welcome-message">
                            <p class="welcome-text">
                                <i class="fas fa-chart-pie me-2"></i>
                                Ready to create amazing polls and vote on others?
                            </p>
                        </div>

                        <form id="registerForm">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-user me-2"></i>Name
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" name="name" class="form-control form-control-glass"
                                        placeholder="Enter your full name" required />
                                    <i class="fas fa-user input-icon"></i>
                                </div>
                            </div>

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
                                        placeholder="Create a strong password" required />
                                    <i class="fas fa-key input-icon"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-check-double me-2"></i>Password Confirmation
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-glass" placeholder="Confirm your password"
                                        required />
                                    <i class="fas fa-shield-alt input-icon"></i>
                                </div>
                            </div>

                            <div id="register-error" class="error-message d-none"></div>

                            <button type="submit" class="btn btn-register">
                                <i class="fas fa-user-plus me-2"></i>
                                Register
                            </button>

                            <div class="login-link">
                                <p>
                                    Already have an account?
                                    <a href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>Login
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

        // 🔐 Block access to this page if user already logged in
        (function() {
            const token = localStorage.getItem("access_token");
            if (token) {
                window.location.href = "/dashboard";
            }
        })();

        // 📝 Submit registration form
        $(document).ready(function() {
            // Initialize particles
            createParticles();

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                const $errorDiv = $('#register-error');
                const $submitBtn = $(this).find('button[type="submit"]');

                // Clear previous errors
                $errorDiv.addClass('d-none').text('');

                // Add loading state
                $submitBtn.addClass('btn-loading').prop('disabled', true);

                const formData = $(this).serialize();

                $.ajax({
                    url: '/api/register',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Success feedback
                        $submitBtn.removeClass('btn-loading').html(
                            '<i class="fas fa-check me-2"></i>Success!');

                        setTimeout(() => {
                            // ✅ Instead of auto-login, redirect to login page
                            window.location.href = '/login?registered=1';
                        }, 500);
                    },
                    error: function(xhr) {
                        let message = 'Registration failed. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        // Show error
                        $errorDiv.removeClass('d-none').html(
                            '<i class="fas fa-exclamation-triangle me-2"></i>' + message);

                        // Remove loading state
                        $submitBtn.removeClass('btn-loading').prop('disabled', false)
                            .html('<i class="fas fa-user-plus me-2"></i>Register');
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
