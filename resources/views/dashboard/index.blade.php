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
            --danger-gradient: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            --info-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.25);
            --text-primary: #2c3e50;
            --text-secondary: #7f8c8d;
            --card-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
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
            animation: gradientFlow 15s ease infinite;
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .particle:nth-child(odd) {
            animation-direction: reverse;
            background: rgba(255, 107, 107, 0.1);
        }

        .particle:nth-child(3n) {
            background: rgba(78, 205, 196, 0.1);
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
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.5);
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Header section */
        .header-section {
            text-align: center;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .main-title {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 50%, #e3f2fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
            animation: titleGlow 3s ease-in-out infinite alternate;
            margin-bottom: 1rem;
        }

        @keyframes titleGlow {
            from {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
                transform: scale(1);
            }

            to {
                text-shadow: 0 0 40px rgba(255, 255, 255, 0.8), 0 0 60px rgba(255, 255, 255, 0.4);
                transform: scale(1.02);
            }
        }

        /* Button styles */
        .btn-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-glass:hover::before {
            left: 100%;
        }

        .btn-glass:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .btn-success-glass {
            background: var(--success-gradient);
            border: none;
        }

        .btn-danger-glass {
            background: var(--danger-gradient);
            border: none;
        }

        .btn-primary-glass {
            background: var(--poll-gradient);
            border: none;
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
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Poll cards */
        .poll-card {
            padding: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
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
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.8rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .poll-description {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 1rem;
            line-height: 1.6;
            font-size: 1rem;
        }

        .poll-badge {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background: var(--poll-gradient);
            color: white;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Section titles */
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 2.5rem;
            text-align: center;
            position: relative;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--poll-gradient);
            border-radius: 2px;
        }

        /* Guest alert */
        .guest-alert {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 1.5rem 2rem;
            color: white;
            text-align: center;
            margin: 1rem 0;
            box-shadow: var(--card-shadow);
        }

        .guest-alert a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            background: var(--poll-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .guest-alert a:hover {
            border-bottom-color: #ffffff;
            transform: translateY(-2px);
        }

        /* Auth section */
        .auth-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
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

        /* Responsive design */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2.5rem;
            }

            .auth-buttons {
                flex-direction: column;
                align-items: center;
            }

            .category-card {
                height: 180px;
                padding: 1.5rem;
            }

            .category-icon {
                font-size: 2.8rem;
            }

            .section-title {
                font-size: 2rem;
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
                        <h6 class="poll-question">{{ $poll->question }}</h6>
                        <p class="poll-description">{{ $poll->description }}</p>
                        <span class="poll-badge">
                            <i class="fas fa-tag me-1"></i>
                            {{ $poll->category->name ?? 'No Category' }}
                        </span>

                        <div class="text-end">
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
                            style="font-size: 4rem; color: rgba(255,255,255,0.7); margin-bottom: 1rem;"></i>
                        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">No polls available yet.</p>
                        <p style="color: rgba(255,255,255,0.7);">Be the first to create one!</p>
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
        });
    </script>
@endpush
