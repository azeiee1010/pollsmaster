@extends('layouts.app')
@section('head')
    <script>
        window.allowGuestPage = true;
    </script>
    <style>
        :root {
            /* Modern soft color palette */
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

            /* Original gradients (keeping for compatibility) */
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --poll-gradient: linear-gradient(135deg, #6366f1 0%, #06b6d4 50%, #8b5cf6 100%);
            --success-gradient: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --danger-gradient: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --info-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);

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

        /* Animated Background Particles */
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

        /* Container styling */
        .container {
            position: relative;
            z-index: 2;
        }

        /* Glass morphism effects */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Header section */
        .header-section {
            text-align: center;
            padding: 3rem 0;
            margin-bottom: 3rem;
        }

        .main-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--primary-color) 50%, var(--accent-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
            letter-spacing: -0.02em;
            position: relative;
            animation: titleFloat 6s ease-in-out infinite;
        }

        .main-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 4px;
            background: var(--poll-gradient);
            border-radius: 2px;
            animation: underlineGlow 2s ease-in-out infinite alternate;
        }

        @keyframes titleFloat {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes underlineGlow {
            from {
                box-shadow: 0 0 5px rgba(99, 102, 241, 0.5);
                transform: translateX(-50%) scaleX(1);
            }

            to {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.8), 0 0 40px rgba(6, 182, 212, 0.4);
                transform: translateX(-50%) scaleX(1.1);
            }
        }

        /* Button styles */
        .btn-glass {
            font-family: 'Poppins', sans-serif;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: var(--text-primary);
            padding: 14px 32px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.5px;
        }

        .btn-glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-glass:hover::before {
            left: 100%;
        }

        .btn-glass:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            color: var(--text-primary);
        }

        .btn-success-glass {
            background: var(--success-gradient);
            border: none;
            color: var(--text-white);
        }

        .btn-success-glass:hover {
            color: var(--text-white);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
        }

        .btn-danger-glass {
            background: var(--danger-gradient);
            border: none;
            color: var(--text-white);
        }

        .btn-danger-glass:hover {
            color: var(--text-white);
            box-shadow: 0 15px 35px rgba(239, 68, 68, 0.4);
        }

        .btn-primary-glass {
            background: var(--poll-gradient);
            border: none;
            color: var(--text-white);
        }

        .btn-primary-glass:hover {
            color: var(--text-white);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
        }

        .btn-teal-glass {
            background: linear-gradient(135deg, var(--accent-color) 0%, #0891b2 100%);
            border: none;
            color: var(--text-white);
        }

        .btn-teal-glass:hover {
            color: var(--text-white);
            box-shadow: 0 15px 35px rgba(6, 182, 212, 0.4);
        }

        /* Category cards */
        .category-card {
            height: 220px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .category-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--poll-gradient);
            border-radius: 20px 20px 0 0;
        }

        .category-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            background: var(--poll-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: iconPulse 2s infinite;
            transition: all 0.3s ease;
        }

        .category-card:hover .category-icon {
            transform: scale(1.15);
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

        .category-card h5 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
            letter-spacing: -0.01em;
        }

        /* Poll cards */
        .poll-card {
            padding: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            max-height: 280px;
        }

        .poll-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--poll-gradient);
            border-radius: 20px 20px 0 0;
        }

        .poll-question {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
            letter-spacing: -0.01em;
            line-height: 1.4;
        }

        .poll-description {
            font-family: 'Poppins', sans-serif;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.6;
            font-size: 1rem;
        }

        .poll-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: var(--bg-tertiary);
            color: var(--text-secondary);
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid var(--border-color);
        }

        /* Section titles */
        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--primary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--poll-gradient);
            border-radius: 2px;
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            from {
                opacity: 0.7;
                transform: translateX(-50%) scaleX(1);
            }

            to {
                opacity: 1;
                transform: translateX(-50%) scaleX(1.2);
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
            }
        }

        /* Guest alert */
        .guest-alert {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 16px;
            padding: 2rem 2.5rem;
            color: var(--text-white);
            text-align: center;
            margin: 2rem 0;
            box-shadow: var(--shadow-lg);
            font-family: 'Poppins', sans-serif;
        }

        .guest-alert a {
            color: var(--text-white);
            text-decoration: none;
            font-weight: 700;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .guest-alert a:hover {
            border-bottom-color: var(--text-white);
            opacity: 0.9;
            transform: translateY(-1px);
        }

        /* Auth section */
        .auth-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 1rem;
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

        .fade-in:nth-child(3) {
            animation-delay: 0.3s;
        }

        .fade-in:nth-child(4) {
            animation-delay: 0.4s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Empty state styling */
        .text-center .glass-card {
            background: var(--glass-bg);
        }

        .text-center .glass-card i {
            color: var(--text-muted) !important;
        }

        .text-center .glass-card p {
            color: var(--text-secondary) !important;
        }

        .text-center .glass-card p:last-child {
            color: var(--text-muted) !important;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2.8rem;
            }

            .auth-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-glass {
                width: 100%;
                max-width: 300px;
                justify-content: center;
                padding: 1rem 2rem;
            }

            .category-card {
                height: 180px;
                padding: 1.5rem;
            }

            .category-icon {
                font-size: 2.8rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .header-section {
                padding: 2rem 0;
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 480px) {
            .main-title {
                font-size: 2.3rem;
            }

            .section-title {
                font-size: 1.9rem;
            }
        }

        /* Custom category icons based on name */
        .category-sports .category-icon::before {
            content: "⚽";
        }

        .category-politics .category-icon::before {
            content: "🗳️";
        }

        .category-study .category-icon::before {
            content: "📚";
        }

        .category-cinema .category-icon::before {
            content: "🎬";
        }

        .category-technology .category-icon::before {
            content: "💻";
        }

        .category-music .category-icon::before {
            content: "🎵";
        }

        .category-food .category-icon::before {
            content: "🍕";
        }

        .category-travel .category-icon::before {
            content: "✈️";
        }

        /* Text clamping utility */
        .clamp-4-lines {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Add Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap');
    </style>
@endsection

@section('content')
    <!-- Floating Particles Background -->
    <div class="particles" id="particles"></div>

    <div class="container mt-4">
        <!-- Header Section -->
        <div class="header-section">
            <h1 class="main-title">Welcome to PollsMaster</h1>

            <div id="auth-section" class="auth-buttons d-none">
                <button class="btn btn-glass btn-success-glass" data-bs-toggle="modal" data-bs-target="#createPollModal">
                    <i class="fas fa-plus"></i> New Poll
                </button>
                <button id="myPoll" class="btn btn-glass btn-teal-glass">
                    <i class="fas fa-list"></i> My Poll
                </button>
                <button id="logoutBtn" class="btn btn-glass btn-danger-glass">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>

            <div id="guest-section" class="guest-alert d-none">
                <i class="fas fa-vote-yea me-2"></i>
                Want to create your own poll? <a href="/login"><i class="fas fa-sign-in-alt me-1"></i>Login</a> to get
                started!
            </div>
        </div>

        <!-- Categories Section -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="section-title">Poll Categories</h2>
            </div>
            @foreach ($categories as $index => $category)
                <div class="col-md-3 mb-3 fade-in">
                    <div class="glass-card category-card category-{{ strtolower($category->name) }}">
                        <div class="category-icon"></div>
                        <h5>{{ $category->name }}</h5>
                        <button class="btn btn-glass btn-primary-glass view-category-polls" data-id="{{ $category->id }}">
                            <i class="fas fa-chart-bar"></i> View Polls
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Recent Polls Section -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Recent Polls</h2>
            </div>
            @forelse($polls as $poll)
                <div class="col-md-6">
                    <div class="glass-card poll-card">
                        <h6 class="poll-question clamp-4-lines">{{ $poll->question }}</h6>
                        <p class="poll-description clamp-4-lines">{{ $poll->description }}</p>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="poll-badge">
                                <i class="fas fa-tag me-1"></i>
                                {{ $poll->category->name ?? 'No Category' }}
                            </span>

                            <a href="{{ url('/polls/view/' . $poll->public_id) }}" class="btn btn-glass btn-primary-glass">
                                <i class="fas fa-poll"></i> View & Vote
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="glass-card text-center" style="padding: 3rem;">
                        <i class="fas fa-poll-h"
                            style="font-size: 4rem; color: rgba(148, 163, 184, 0.7); margin-bottom: 1rem;"></i>
                        <p style="color: rgba(100, 116, 139, 0.9); font-size: 1.2rem;">No polls available yet.</p>
                        <p style="color: rgba(148, 163, 184, 0.7);">Be the first to create one!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @include('dashboard.partials.create_poll_modal')
@endsection

@push('scripts')
    <script>
        // Create floating particles
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

            let optionCount = 2;

            // Add new option input
            $('#addOptionBtn').on('click', function() {
                optionCount++;
                const optionField = `
                <div class="input-group mb-2">
                    <input type="text" name="options[]" class="form-control" placeholder="Option ${optionCount}" required>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-option">×</button>
                </div>`;
                $('#optionsWrapper').append(optionField);
            });

            // Remove option input
            $(document).on('click', '.remove-option', function() {
                $(this).closest('.input-group').remove();
            });

            // Toast function
            function showToast(message, isSuccess = true) {
                const $toast = $('#commonToast');
                const $body = $('#commonToastBody');

                $toast.removeClass('bg-success bg-danger')
                    .addClass(isSuccess ? 'bg-success' : 'bg-danger');

                $body.html(message);
                const toast = new bootstrap.Toast($toast[0]);
                toast.show();
            }

            // AJAX submit form
            $('#createPollForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = form.serialize();

                $.ajax({
                    url: '/api/polls',
                    method: 'POST',
                    data: formData,
                    success: function(res) {
                        $('#createPollModal').modal('hide');
                        showToast('✅ Poll created successfully!');
                        form[0].reset();
                        $('#optionsWrapper').html(`
                        <div class="input-group mb-2">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 1" required>
                        </div>
                        <div class="input-group mb-2">
                            <input type="text" name="options[]" class="form-control" placeholder="Option 2" required>
                        </div>
                    `);
                        optionCount = 2;
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function(xhr) {
                        let message = '❌ Something went wrong.';
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            const errors = Object.values(xhr.responseJSON.errors).flat();
                            message = errors.join('<br>');
                        } else if (xhr.responseJSON?.message) {
                            message = xhr.responseJSON.message;
                        }
                        showToast(message, false);
                    }
                });
            });

            $('.view-category-polls').on('click', function() {
                var categoryId = $(this).data('id');
                window.location.href = '/polls/category/' + categoryId;
            });

            const token = localStorage.getItem('access_token');

            if (token) {
                $('#auth-section').removeClass('d-none');
                $('#guest-section').addClass('d-none');
            } else {
                $('#auth-section').addClass('d-none');
                $('#guest-section').removeClass('d-none');
            }

            // Logout handler
            $('#logoutBtn').on('click', function() {
                localStorage.removeItem('access_token');
                window.location.href = '/login';
            });

            // my poll handler
            $('#myPoll').on('click', function() {
                window.location.href = '/polls/user';
            });

            // Add hover effects to buttons
            $('.btn-glass').hover(
                function() {
                    $(this).find('i').addClass('fa-bounce');
                },
                function() {
                    $(this).find('i').removeClass('fa-bounce');
                }
            );
        });
    </script>
@endpush
