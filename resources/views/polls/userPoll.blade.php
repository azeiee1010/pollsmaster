@extends('layouts.app')

@section('head')
    <style>
        :root {
            /* Modern soft color palette - matching login/register */
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

        /* Add Google Fonts - matching login */
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

        /* Animated Background Particles - matching login */
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

        /* Main container */
        .main-container {
            position: relative;
            z-index: 2;
            padding: 2rem 0;
        }

        /* Page Header - matching login card header */
        .page-header-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 3rem;
            animation: slideInUp 0.8s ease-out;
        }

        .page-header {
            background: var(--poll-gradient);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
        }

        .page-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.8rem;
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

        .page-subtitle {
            color: rgba(255, 255, 255, 0.9);
            margin-top: 0.8rem;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
            font-weight: 400;
        }

        .page-icon {
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

        /* Breadcrumb */
        .breadcrumb-section {
            padding: 1.5rem 2rem;
            background: var(--bg-tertiary);
            border-bottom: 1px solid var(--border-color);
        }

        .breadcrumb-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            color: var(--text-secondary);
        }

        .breadcrumb-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .breadcrumb-link:hover {
            color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .breadcrumb-separator {
            color: var(--text-muted);
            margin: 0 0.5rem;
        }

        .breadcrumb-current {
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Loading State - matching login loading */
        .loading-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 4rem 2rem;
            animation: fadeIn 0.5s ease-out;
        }

        .loading-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            padding: 3rem 4rem;
            text-align: center;
            animation: loadingPulse 2s ease-in-out infinite;
        }

        @keyframes loadingPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .loading-spinner {
            width: 3rem;
            height: 3rem;
            border: 3px solid rgba(99, 102, 241, 0.2);
            border-top-color: var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1.5rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading-text {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1.1rem;
            font-family: 'Poppins', sans-serif;
        }

        /* Poll Cards - consistent with login card styling */
        .poll-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: slideInUp 0.8s ease-out;
            cursor: pointer;
            position: relative;
            height: 100%;
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

        .poll-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .poll-card-body {
            padding: 2rem;
        }

        .poll-question {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.3rem;
            line-height: 1.4;
            margin-bottom: 1rem;
            font-family: 'Poppins', sans-serif;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .poll-meta {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Poppins', sans-serif;
        }

        .poll-meta i {
            color: var(--primary-color);
        }

        /* Poll action button - matching login button */
        .poll-btn {
            font-family: 'Poppins', sans-serif;
            background: var(--poll-gradient);
            border: none;
            border-radius: 16px;
            padding: 0.75rem 1.5rem;
            color: var(--text-white);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .poll-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .poll-btn:hover::before {
            left: 100%;
        }

        .poll-btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
            color: var(--text-white);
        }

        .poll-btn i {
            transition: transform 0.3s ease;
        }

        .poll-card:hover .poll-btn i {
            transform: translateX(3px);
        }

        /* Back button - matching login register link style */
        .back-btn {
            font-family: 'Poppins', sans-serif;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 1rem 2rem;
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow-md);
        }

        .back-btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.2);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Empty State - matching login welcome message */
        .empty-state {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            padding: 4rem 2rem;
            text-align: center;
            animation: slideInUp 0.8s ease-out;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            animation: iconPulse 2s infinite;
        }

        .empty-state-title {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            font-family: 'Space Grotesk', sans-serif;
        }

        .empty-state-text {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.6;
            font-family: 'Poppins', sans-serif;
        }

        /* Error State - matching login error */
        .error-state {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid rgba(239, 68, 68, 0.2);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            padding: 3rem 2rem;
            text-align: center;
            animation: slideInUp 0.8s ease-out;
        }

        .error-state-icon {
            font-size: 3rem;
            color: var(--danger-color);
            margin-bottom: 1rem;
        }

        .error-state-title {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-family: 'Space Grotesk', sans-serif;
        }

        .error-state-text {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-family: 'Poppins', sans-serif;
        }

        .retry-btn {
            font-family: 'Poppins', sans-serif;
            background: var(--danger-gradient);
            border: none;
            border-radius: 16px;
            padding: 0.75rem 1.5rem;
            color: var(--text-white);
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .retry-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        /* Animations */
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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: slideInUp 0.8s ease-out forwards;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }

            .poll-card-body {
                padding: 1.5rem;
            }

            .poll-question {
                font-size: 1.1rem;
            }

            .empty-state,
            .error-state {
                padding: 3rem 1.5rem;
            }

            .page-header {
                padding: 2rem 1.5rem;
            }

            .main-container {
                padding: 1rem 0;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
            }

            .poll-btn,
            .back-btn {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Floating Particles Background -->
    <div class="particles" id="particles"></div>

    <div class="main-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header-card fade-in">
                <div class="breadcrumb-section">
                    <nav class="breadcrumb-nav">
                        <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                        <span class="breadcrumb-separator">/</span>
                        <span class="breadcrumb-current">My Polls</span>
                    </nav>
                </div>

                <div class="page-header">
                    <div class="page-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h1 class="page-title">My Polls</h1>
                    <p class="page-subtitle">Manage and view all the polls you've created</p>
                </div>
            </div>

            <!-- Loading State -->
            <div class="loading-container" id="loadingSpinner">
                <div class="loading-card">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading your amazing polls...</p>
                </div>
            </div>

            <!-- Polls Grid -->
            <div class="row" id="pollListByUser">
                <!-- Polls will be loaded here -->
            </div>

            <!-- Back Button -->
            <div class="text-center mt-5 fade-in">
                <a href="{{ route('dashboard') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Create floating particles - matching login
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

            let animationDelay = 0;

            $.ajax({
                url: `/api/polls/user`,
                method: 'GET',
                success: function(response) {
                    // Hide loading spinner
                    $('#loadingSpinner').fadeOut(300);

                    const container = $('#pollListByUser');
                    container.empty();

                    if (response.length === 0) {
                        const emptyStateHtml = `
                            <div class="col-12">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-poll-h"></i>
                                    </div>
                                    <h3 class="empty-state-title">No Polls Created Yet</h3>
                                    <p class="empty-state-text">
                                        You haven't created any polls yet.<br>
                                        Start by creating your first poll to engage your audience!
                                    </p>
                                </div>
                            </div>`;
                        container.html(emptyStateHtml);
                        return;
                    }

                    response.forEach((poll, index) => {
                        animationDelay += 100;

                        const html = `
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="poll-card h-100 fade-in" 
                                     style="animation-delay: ${animationDelay}ms;"
                                     onclick="window.location.href='/polls/view/${poll.public_id}'">
                                    <div class="poll-card-body">
                                        <h5 class="poll-question">${poll.question}</h5>
                                        <div class="poll-meta">
                                            <i class="fas fa-clock"></i>
                                            Created ${poll.created_diff}
                                        </div>
                                        <a href="/polls/view/${poll.public_id}" 
                                           class="poll-btn"
                                           onclick="event.stopPropagation();">
                                            <i class="fas fa-eye"></i>
                                            View Poll
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>`;
                        container.append(html);
                    });
                },
                error: function() {
                    // Hide loading spinner
                    $('#loadingSpinner').fadeOut(300);

                    const errorStateHtml = `
                        <div class="col-12">
                            <div class="error-state">
                                <div class="error-state-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h3 class="error-state-title">Oops! Something went wrong</h3>
                                <p class="error-state-text">Failed to load your polls. Please try refreshing the page.</p>
                                <button class="retry-btn" onclick="location.reload()">
                                    <i class="fas fa-redo"></i>
                                    Try Again
                                </button>
                            </div>
                        </div>`;
                    $('#pollListByUser').html(errorStateHtml);
                }
            });

            // Add hover effects to buttons
            $(document).on('mouseenter', '.poll-btn', function() {
                $(this).find('i:last').addClass('fa-bounce');
            });

            $(document).on('mouseleave', '.poll-btn', function() {
                $(this).find('i:last').removeClass('fa-bounce');
            });

            $('.back-btn').hover(
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
