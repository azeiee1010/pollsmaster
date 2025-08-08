@forelse($polls as $poll)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card poll-card h-100 border-0 shadow-lg overflow-hidden position-relative"
            data-public-id="{{ $poll->public_id }}"
            style="cursor: pointer; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); border-radius: 20px; background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);">

            <!-- Gradient Border Effect -->
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); 
                        border-radius: 20px; padding: 2px; z-index: 0;">
                <div class="w-100 h-100 bg-white" style="border-radius: 18px;"></div>
            </div>

            <!-- Animated Background Glow -->
            <div class="position-absolute top-0 start-0 w-100 h-100 opacity-0 poll-glow"
                style="background: radial-gradient(circle at 50% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 70%); 
                        border-radius: 20px; transition: opacity 0.4s ease; z-index: 1;">
            </div>

            <div class="card-body p-4 position-relative" style="z-index: 2;">
                <!-- Category Badge -->
                <div class="mb-3">
                    <span class="badge px-3 py-2 fw-medium"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                 color: white; 
                                 border-radius: 25px; 
                                 font-size: 0.75rem; 
                                 letter-spacing: 0.5px;
                                 box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                        {{ $poll->category->name }}
                    </span>
                </div>

                <!-- Poll Question -->
                <h5 class="card-title mb-3 fw-bold"
                    style="color: #1a202c; 
                           font-size: 1.25rem; 
                           line-height: 1.4; 
                           display: -webkit-box; 
                           -webkit-line-clamp: 2; 
                           -webkit-box-orient: vertical; 
                           overflow: hidden;">
                    {{ $poll->question }}
                </h5>

                <!-- Created Date -->
                <p class="card-text mb-4">
                    <small class="text-muted d-flex align-items-center" style="font-size: 0.85rem;">
                        <i class="fas fa-clock me-2" style="color: #9ca3af;"></i>
                        Created {{ $poll->created_at->diffForHumans() }}
                    </small>
                </p>

                <!-- Bottom Section -->
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <!-- Vote Count -->
                    <div class="d-flex align-items-center">
                        <div class="vote-badge px-3 py-2 rounded-pill d-flex align-items-center"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                    color: white; 
                                    font-weight: 600; 
                                    font-size: 0.875rem;
                                    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
                                    transition: transform 0.3s ease;">
                            <i class="fas fa-vote-yea me-2" style="font-size: 0.875rem;"></i>
                            {{ $poll->votes_count }} {{ Str::plural('Vote', $poll->votes_count) }}
                        </div>
                    </div>

                    <!-- Click Indicator -->
                    <div class="click-indicator d-flex align-items-center"
                        style="color: #667eea; font-weight: 600; font-size: 0.875rem;">
                        <span class="me-2">View Poll</span>
                        <i class="fas fa-arrow-right" style="transition: transform 0.3s ease; font-size: 0.75rem;"></i>
                    </div>
                </div>
            </div>

            <!-- Hover Overlay -->
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0 hover-overlay"
                style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%); 
                        border-radius: 20px; 
                        transition: all 0.4s ease; 
                        z-index: 3;">
                <div class="text-center text-white">
                    <i class="fas fa-eye fa-2x mb-2" style="animation: pulse 2s infinite;"></i>
                    <p class="mb-0 fw-bold">Click to View Results</p>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert border-0 text-center py-5"
            style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); 
                    border-radius: 20px; 
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);">
            <div class="mb-3">
                <i class="fas fa-poll fa-3x" style="color: #cbd5e0;"></i>
            </div>
            <h5 class="mb-2" style="color: #4a5568; font-weight: 600;">No Polls Available</h5>
            <p class="mb-0 text-muted">There are currently no polls to display. Check back later!</p>
        </div>
    </div>
@endforelse

<style>
    /* Poll Card Hover Effects */
    .poll-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15) !important;
    }

    .poll-card:hover .poll-glow {
        opacity: 1;
    }

    .poll-card:hover .hover-overlay {
        opacity: 1;
    }

    .poll-card:hover .click-indicator i {
        transform: translateX(5px);
    }

    .poll-card:hover .vote-badge {
        transform: scale(1.05);
    }

    /* Pulse Animation for Eye Icon */
    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    /* Additional smooth transitions */
    .poll-card {
        will-change: transform;
    }

    .poll-card * {
        transition: inherit;
    }

    /* Ensure proper stacking and smooth hover */
    .hover-overlay {
        backdrop-filter: blur(2px);
    }

    /* Vote badge hover animation */
    .vote-badge:hover {
        animation: voteBadgeBounce 0.6s ease-in-out;
    }

    @keyframes voteBadgeBounce {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    /* Category badge subtle hover */
    .poll-card:hover .badge {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* Enhanced card body content spacing on hover */
    .poll-card:hover .card-body {
        transform: translateZ(10px);
    }

    /* Smooth gradient border animation */
    .poll-card:hover>div:first-child {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 30%, #f093fb 60%, #667eea 100%);
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
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

    /* Empty state hover effect */
    .alert:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .poll-card:hover {
            transform: translateY(-4px) scale(1.01);
        }

        .poll-card .card-body {
            padding: 1.5rem;
        }

        .poll-card .card-title {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .poll-card {
            border-radius: 16px;
        }

        .poll-card>div:first-child,
        .poll-glow,
        .hover-overlay {
            border-radius: 16px;
        }

        .poll-card>div:first-child>div {
            border-radius: 14px;
        }
    }

    /* Focus accessibility */
    .poll-card:focus-visible {
        outline: 3px solid #667eea;
        outline-offset: 2px;
    }

    /* Smooth loading animation for cards */
    .poll-card {
        animation: cardFadeIn 0.6s ease-out forwards;
        opacity: 0;
    }

    .poll-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .poll-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .poll-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .poll-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    .poll-card:nth-child(5) {
        animation-delay: 0.5s;
    }

    .poll-card:nth-child(6) {
        animation-delay: 0.6s;
    }

    @keyframes cardFadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
