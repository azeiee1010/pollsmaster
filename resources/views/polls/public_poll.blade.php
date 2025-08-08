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
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Poll Card - matching login card structure */
        .poll-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            animation: slideInUp 0.8s ease-out;
            max-width: 800px;
            width: 100%;
            margin: 1rem;
        }

        .poll-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Poll Header - matching login header */
        .poll-header {
            background: var(--poll-gradient);
            padding: 3rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .poll-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
        }

        .poll-icon {
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

        .poll-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            margin: 0 0 1rem 0;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            letter-spacing: -0.02em;
            animation: titleFloat 6s ease-in-out infinite;
            line-height: 1.3;
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

        .poll-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
            font-weight: 400;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        /* Total Votes Badge */
        .total-votes-badge {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: badgePulse 2s infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes badgePulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            }
        }

        /* Poll Body */
        .poll-body {
            padding: 3rem 2.5rem 2.5rem;
        }

        /* Loading State - matching login loading */
        .loading-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
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
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        /* Option Buttons - matching login button style */
        .option-button {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-primary);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-align: center;
        }

        .option-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .option-button:hover::before {
            left: 100%;
        }

        .option-button:hover {
            transform: translateY(-4px) scale(1.02);
            border-color: var(--primary-color);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.2);
            color: var(--primary-color);
        }

        .option-button:active {
            transform: translateY(-2px) scale(1.01);
            transition: transform 0.1s;
        }

        .option-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none !important;
        }

        .option-button.loading {
            color: transparent !important;
        }

        .option-button.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top-color: var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Results Display */
        .result-item {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-sm);
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            transition: all 0.3s ease;
        }

        .result-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .result-option-text {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .result-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .result-progress {
            background: var(--bg-tertiary);
            border-radius: 10px;
            height: 12px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .result-progress-bar {
            background: var(--poll-gradient);
            height: 100%;
            border-radius: 10px;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .result-progress-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        /* Back Button - matching login register link */
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
            .poll-header {
                padding: 2rem 1.5rem 1.5rem;
            }

            .poll-title {
                font-size: 1.8rem;
            }

            .poll-description {
                font-size: 1rem;
            }

            .poll-body {
                padding: 2rem 1.5rem;
            }

            .option-button {
                padding: 1.2rem 1.5rem;
                font-size: 1rem;
            }

            .total-votes-badge {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .poll-icon {
                font-size: 3rem;
            }
        }

        @media (max-width: 480px) {
            .poll-title {
                font-size: 1.6rem;
            }

            .option-button,
            .back-btn {
                padding: 1rem 1.25rem;
                font-size: 0.95rem;
            }

            .main-container {
                padding: 1rem 0;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Floating Particles Background -->
    <div class="particles" id="particles"></div>

    <div class="main-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="poll-card fade-in">
                        <!-- Poll Header -->
                        <div class="poll-header">
                            <div class="poll-icon">
                                <i class="fas fa-poll"></i>
                            </div>
                            <h1 id="poll-question" class="poll-title">Loading...</h1>
                            <p id="poll-description" class="poll-description"></p>

                            <!-- Total Votes Display -->
                            <div id="total-votes-container" class="total-votes-badge" style="display: none;">
                                <i class="fas fa-users me-2"></i>
                                <span id="total-votes">0</span> Total Votes
                            </div>
                        </div>

                        <!-- Poll Body -->
                        <div class="poll-body">
                            <!-- Options/Results Container -->
                            <div id="options-container">
                                <!-- Loading spinner -->
                                <div class="loading-container">
                                    <div>
                                        <div class="loading-spinner"></div>
                                        <p class="loading-text">Loading poll options...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Back Button -->
                            <div class="text-center mt-4">
                                <a href="javascript:history.back()" class="back-btn">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Polls
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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

            const publicId = "{{ $public_id }}";
            const baseUrl = window.location.origin;
            const csrfToken = "{{ csrf_token() }}";

            // Load Poll Data
            $.ajax({
                url: `${baseUrl}/api/polls/public/${publicId}`,
                method: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    $('#poll-question').text(data.poll.question);
                    $('#poll-description').text(data.poll.description || '');

                    const container = $('#options-container');
                    container.empty();

                    console.log("data", data);

                    if (data.has_voted) {
                        loadResults(publicId); // If already voted, show results directly
                    } else {
                        // Show voting options
                        data.options.forEach((opt, index) => {
                            const button = $(`
                                <button class="option-button fade-in" data-option-id="${opt.id}" 
                                        style="animation-delay: ${(index + 1) * 100}ms;">
                                    ${opt.text}
                                </button>
                            `);
                            container.append(button);
                        });

                        $('.option-button').on('click', function() {
                            const optionId = $(this).data('option-id');
                            const $clickedButton = $(this);

                            // Disable all buttons and show loading state
                            $('.option-button').prop('disabled', true);
                            $clickedButton.addClass('loading');

                            $.ajax({
                                url: `${baseUrl}/api/polls/${publicId}/vote`,
                                method: 'POST',
                                data: {
                                    option_id: optionId
                                },
                                success: function(res) {
                                    if (res.error) {
                                        alert(res.error);
                                        $('.option-button').prop('disabled', false)
                                            .removeClass('loading');
                                        return;
                                    }

                                    // Success feedback
                                    $clickedButton.removeClass('loading')
                                        .html(
                                            '<i class="fas fa-check me-2"></i>Vote Recorded!'
                                            )
                                        .css({
                                            'background': 'var(--success-gradient)',
                                            'color': 'white',
                                            'border-color': 'transparent'
                                        });

                                    setTimeout(() => {
                                        showResults(res
                                        .results); // Show new result after vote
                                    }, 1000);
                                },
                                error: function(err) {
                                    alert("Vote failed. Try again.");
                                    $('.option-button').prop('disabled', false)
                                        .removeClass('loading');
                                    console.error(err.responseText);
                                }
                            });
                        });
                    }
                },
                error: function() {
                    const container = $('#options-container');
                    container.html(`
                        <div class="text-center">
                            <div style="color: var(--danger-color); font-size: 3rem; margin-bottom: 1rem;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3 style="color: var(--text-primary); margin-bottom: 1rem; font-family: 'Space Grotesk', sans-serif;">
                                Failed to Load Poll
                            </h3>
                            <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">
                                There was an error loading this poll. Please try again.
                            </p>
                            <button class="back-btn" onclick="location.reload()">
                                <i class="fas fa-redo me-2"></i>Try Again
                            </button>
                        </div>
                    `);
                }
            });

            function loadResults(pollId) {
                console.log("Loading results for poll:", pollId);
                $.ajax({
                    url: `${baseUrl}/api/polls/${pollId}/results`,
                    method: 'GET',
                    success: function(res) {
                        showResults(res.results);
                    },
                    error: function() {
                        alert("Failed to load results.");
                    }
                });
            }

            function showResults(results) {
                const container = $('#options-container');
                container.empty();

                let totalVotes = results.reduce((sum, r) => sum + r.votes, 0);

                // Show total votes
                $('#total-votes').text(totalVotes);
                $('#total-votes-container').fadeIn(500);

                results.forEach((r, index) => {
                    let percent = totalVotes > 0 ? Math.round((r.votes / totalVotes) * 100) : 0;

                    const resultRow = $(`
                        <div class="result-item fade-in" style="animation-delay: ${index * 150}ms;">
                            <div class="result-option-text">${r.option}</div>
                            <div class="result-meta">
                                <span>${r.votes} votes</span>
                                <span>${percent}%</span>
                            </div>
                            <div class="result-progress">
                                <div class="result-progress-bar" role="progressbar" style="width: 0%;"></div>
                            </div>
                        </div>
                    `);
                    container.append(resultRow);

                    // Animate progress bar
                    setTimeout(() => {
                        resultRow.find('.result-progress-bar').css('width', `${percent}%`);
                    }, 500 + (index * 150));
                });
            }

            // Add hover effects to buttons
            $(document).on('mouseenter', '.option-button:not(:disabled)', function() {
                $(this).find('i').addClass('fa-bounce');
            });

            $(document).on('mouseleave', '.option-button', function() {
                $(this).find('i').removeClass('fa-bounce');
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
