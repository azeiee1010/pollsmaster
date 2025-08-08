@extends('layouts.app')
@section('head')
    <script>
        window.allowGuestPage = true;
    </script>
    <style>
        :root {
            /* Modern soft color palette - matching homepage */
            --primary-color: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary-color: #f1f5f9;
            --accent-color: #06b6d4;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;

            /* Background colors */
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;

            /* Text colors */
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --text-white: #ffffff;

            /* Gradients */
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --poll-gradient: linear-gradient(135deg, #6366f1 0%, #06b6d4 50%, #8b5cf6 100%);
            --success-gradient: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --danger-gradient: linear-gradient(135deg, #ef4444 0%, #f87171 100%);

            /* Glass morphism with softer colors */
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.3);
            --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);

            /* Border and shadow */
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Add Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%, #f8fafc 100%);
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

        /* Animated Background Particles - matching homepage */
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
            background: rgba(99, 102, 241, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .particle:nth-child(odd) {
            animation-direction: reverse;
            background: rgba(139, 92, 246, 0.08);
        }

        .particle:nth-child(3n) {
            background: rgba(6, 182, 212, 0.08);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-40px) rotate(120deg);
            }

            66% {
                transform: translateY(-80px) rotate(240deg);
            }
        }

        /* Container positioning */
        .container {
            position: relative;
            z-index: 2;
        }

        /* Login card styling - matching homepage glass cards */
        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
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
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Header styling */
        .login-header {
            background: var(--poll-gradient);
            padding: 3rem 2rem 2rem;
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
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin: 0;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            letter-spacing: -0.02em;
            animation: titleFloat 6s ease-in-out infinite;
        }

        @keyframes titleFloat {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.9);
            margin-top: 0.8rem;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
            font-weight: 400;
        }

        .login-icon {
            font-size: 3.5rem;
            color: white;
            margin-bottom: 1rem;
            animation: iconPulse 2s infinite;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
        }

        @keyframes iconPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Form body styling */
        .login-body {
            padding: 3rem 2.5rem 2.5rem;
        }

        /* Welcome message */
        .welcome-message {
            text-align: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: var(--bg-tertiary);
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .welcome-text {
            color: var(--text-secondary);
            font-size: 1rem;
            line-height: 1.6;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* Form controls */
        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-label {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 1rem;
            display: block;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .form-control-glass {
            background: var(--bg-primary);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: 1rem 3.5rem 1rem 1.2rem;
            color: var(--text-primary);
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            font-family: 'Poppins', sans-serif;
            box-shadow: var(--shadow-sm);
        }

        .form-control-glass::placeholder {
            color: var(--text-muted);
            transition: all 0.3s ease;
        }

        .form-control-glass:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1), var(--shadow-md);
            background: var(--bg-primary);
            transform: translateY(-2px);
        }

        .form-control-glass:focus::placeholder {
            color: var(--text-secondary);
            transform: translateY(-2px);
        }

        /* Input icons */
        .input-icon {
            position: absolute;
            right: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.1rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.1);
        }

        .input-wrapper {
            position: relative;
        }

        /* Submit button - matching homepage button styles */
        .btn-login {
            font-family: 'Poppins', sans-serif;
            background: var(--poll-gradient);
            border: none;
            border-radius: 16px;
            padding: 1.2rem 2rem;
            color: var(--text-white);
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-transform: none;
            letter-spacing: 0.5px;
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
            color: var(--text-white);
        }

        .btn-login:active {
            transform: translateY(-2px) scale(1.01);
            transition: transform 0.1s;
        }

        /* Error message styling */
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid rgba(239, 68, 68, 0.2);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            color: var(--danger-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            animation: errorSlide 0.5s ease-out;
            font-family: 'Poppins', sans-serif;
        }

        @keyframes errorSlide {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Register link */
        .register-link {
            text-align: center;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .register-link p {
            color: var(--text-secondary);
            margin: 0;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .register-link a:hover {
            color: var(--primary-dark);
            transform: translateY(-2px);
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

        /* Loading animations */
        .fade-in {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .fade-in:nth-child(1) {
            animation-delay: 0.1s;
        }

        .fade-in:nth-child(2) {
            animation-delay: 0.2s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .login-card {
                margin: 1rem;
                border-radius: 16px;
            }

            .login-header {
                padding: 2rem 1.5rem 1.5rem;
            }

            .login-title {
                font-size: 2rem;
            }

            .login-body {
                padding: 2rem 1.5rem;
            }

            .login-icon {
                font-size: 3rem;
            }

            .form-control-glass {
                padding: 1rem 3rem 1rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .login-title {
                font-size: 1.8rem;
            }

            .btn-login {
                padding: 1rem 1.5rem;
                font-size: 1rem;
            }
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
                        <p class="login-subtitle">Sign in to continue your polling journey</p>
                    </div>

                    <div class="login-body">
                        <div class="welcome-message fade-in">
                            <p class="welcome-text">
                                <i class="fas fa-poll me-2" style="color: var(--primary-color);"></i>
                                Ready to create amazing polls and engage with your community?
                            </p>
                        </div>

                        <form id="loginForm" class="fade-in">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-envelope me-2" style="color: var(--primary-color);"></i>Email Address
                                </label>
                                <div class="input-wrapper">
                                    <input type="email" name="email" class="form-control form-control-glass"
                                        placeholder="Enter your email address" required />
                                    <i class="fas fa-at input-icon"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-lock me-2" style="color: var(--primary-color);"></i>Password
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" name="password" class="form-control form-control-glass"
                                        placeholder="Enter your password" required />
                                    <i class="fas fa-key input-icon"></i>
                                </div>
                            </div>

                            <div id="login-error" class="error-message d-none"></div>

                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt"></i>
                                Sign In
                            </button>

                            <div class="register-link">
                                <p>
                                    Don't have an account?
                                    <a href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i>Create Account
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
        // Create floating particles - matching homepage
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 60;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                // Random size between 6px and 16px
                const size = Math.random() * 10 + 6;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';

                // Random animation duration
                particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
                particle.style.animationDelay = Math.random() * 3 + 's';

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

            // Form submission
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

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
                            '<i class="fas fa-check me-2"></i>Welcome Back!'
                        ).css({
                            'background': 'var(--success-gradient)',
                            'transform': 'translateY(-4px) scale(1.02)',
                            'box-shadow': '0 15px 35px rgba(16, 185, 129, 0.4)'
                        });

                        setTimeout(() => {
                            window.location.href = '/dashboard';
                        }, 800);
                    },
                    error: function(xhr) {
                        let message = 'Login failed. Please check your credentials.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        // Show error
                        $errorDiv.removeClass('d-none').html(
                            '<i class="fas fa-exclamation-triangle me-2"></i>' + message
                        );

                        // Remove loading state
                        $submitBtn.removeClass('btn-loading').prop('disabled', false)
                            .html('<i class="fas fa-sign-in-alt me-2"></i>Sign In');

                        // Add shake animation
                        $('.login-card').css('animation', 'shake 0.6s ease-in-out');
                        setTimeout(() => {
                            $('.login-card').css('animation',
                            'slideInUp 0.8s ease-out');
                        }, 600);
                    }
                });
            });

            // Enhanced input focus effects
            $('.form-control-glass').on('focus', function() {
                $(this).closest('.form-group').find('.form-label')
                    .css('color', 'var(--primary-color)')
                    .css('transform', 'translateY(-2px)');
            });

            $('.form-control-glass').on('blur', function() {
                $(this).closest('.form-group').find('.form-label')
                    .css('color', 'var(--text-primary)')
                    .css('transform', 'translateY(0)');
            });

            // Add hover effects to buttons - matching homepage
            $('.btn-login').hover(
                function() {
                    $(this).find('i').addClass('fa-bounce');
                },
                function() {
                    $(this).find('i').removeClass('fa-bounce');
                }
            );
        });

        // Add shake animation keyframes
        const shakeKeyframes = `
            @keyframes shake {
                0%, 100% { transform: translateX(0) translateY(-8px); }
                25% { transform: translateX(-10px) translateY(-8px); }
                75% { transform: translateX(10px) translateY(-8px); }
            }
        `;

        const styleSheet = document.createElement('style');
        styleSheet.textContent = shakeKeyframes;
        document.head.appendChild(styleSheet);
    </script>
@endpush
