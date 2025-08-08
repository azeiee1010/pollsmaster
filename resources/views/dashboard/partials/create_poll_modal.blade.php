<!-- Poll Create Modal -->
<div class="modal fade" id="createPollModal" tabindex="-1" aria-labelledby="createPollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modern-modal">
            <form id="createPollForm">
                <div class="modal-header modern-header">
                    <div class="header-content">
                        <div class="modal-icon">
                            <i class="fas fa-poll"></i>
                        </div>
                        <div>
                            <h5 class="modal-title" id="createPollModalLabel">Create New Poll</h5>
                            <p class="modal-subtitle">Design your poll and engage your audience</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close modern-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body modern-body">
                    <!-- Question -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            <i class="fas fa-question-circle me-2"></i>Question
                        </label>
                        <div class="input-wrapper-modern">
                            <input type="text" name="question" class="form-control-modern"
                                placeholder="What would you like to ask?" required>
                            <i class="fas fa-edit input-icon-modern"></i>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            <i class="fas fa-align-left me-2"></i>Description <span
                                class="optional-text">(optional)</span>
                        </label>
                        <div class="input-wrapper-modern">
                            <textarea name="description" class="form-control-modern textarea-modern" rows="3"
                                placeholder="Add more context to your poll..."></textarea>
                            <i class="fas fa-file-alt input-icon-modern textarea-icon"></i>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            <i class="fas fa-tag me-2"></i>Category
                        </label>
                        <div class="input-wrapper-modern">
                            <select name="category_id" class="form-control-modern select-modern" required>
                                <option value="">Choose a category...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down input-icon-modern select-arrow"></i>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            <i class="fas fa-list-ul me-2"></i>Poll Options
                        </label>
                        <div id="optionsWrapper" class="options-container">
                            <div class="option-item">
                                <div class="input-wrapper-modern">
                                    <input type="text" name="options[]" class="form-control-modern"
                                        placeholder="First option..." required>
                                    <i class="fas fa-circle input-icon-modern option-bullet"></i>
                                </div>
                            </div>
                            <div class="option-item">
                                <div class="input-wrapper-modern">
                                    <input type="text" name="options[]" class="form-control-modern"
                                        placeholder="Second option..." required>
                                    <i class="fas fa-circle input-icon-modern option-bullet"></i>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addOptionBtn" class="btn-add-option">
                            <i class="fas fa-plus me-2"></i>Add Another Option
                        </button>
                    </div>

                    <!-- Expires At -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            <i class="fas fa-clock me-2"></i>Expires At <span class="optional-text">(optional)</span>
                        </label>
                        <div class="input-wrapper-modern">
                            <input type="datetime-local" name="expires_at" class="form-control-modern">
                            <i class="fas fa-calendar-alt input-icon-modern"></i>
                        </div>
                    </div>

                    <div id="create-poll-error" class="error-message-modern d-none"></div>
                </div>

                <div class="modal-footer modern-footer">
                    <button type="button" class="btn-secondary-modern" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn-primary-modern">
                        <i class="fas fa-poll me-2"></i>Create Poll
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modern Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="commonToast" class="toast modern-toast align-items-center border-0" role="alert">
        <div class="d-flex align-items-center">
            <div class="toast-icon me-3">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast-body text-white flex-grow-1" id="commonToastBody"></div>
            <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<style>
    /* Modern Modal Styles - Matching Login/Register Design */
    :root {
        /* Using same variables from login/register */
        --primary-color: #6366f1;
        --primary-light: #818cf8;
        --primary-dark: #4f46e5;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --text-white: #ffffff;
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --bg-tertiary: #f1f5f9;
        --border-color: #e2e8f0;
        --poll-gradient: linear-gradient(135deg, #6366f1 0%, #06b6d4 50%, #8b5cf6 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(255, 255, 255, 0.3);
        --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modern-modal {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        font-family: 'Poppins', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        animation: modalSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modern-header {
        background: var(--poll-gradient);
        padding: 2rem 2.5rem;
        border-bottom: none;
        position: relative;
        overflow: hidden;
    }

    .modern-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 1;
    }

    .modal-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        animation: iconPulse 2s infinite;
    }

    @keyframes iconPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .modal-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .modal-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
        margin: 0.25rem 0 0 0;
        font-weight: 400;
    }

    .modern-close {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .modern-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .modern-body {
        padding: 2.5rem;
        background: var(--bg-primary);
    }

    .form-group-modern {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label-modern {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.8rem;
        display: block;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
    }

    .optional-text {
        color: var(--text-muted);
        font-weight: 400;
        font-size: 0.85rem;
        margin-left: 0.5rem;
    }

    .input-wrapper-modern {
        position: relative;
    }

    .form-control-modern {
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem 3rem 1rem 1rem;
        color: var(--text-primary);
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1), 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .form-control-modern::placeholder {
        color: var(--text-muted);
    }

    .textarea-modern {
        resize: vertical;
        min-height: 80px;
        padding-top: 1rem;
    }

    .select-modern {
        appearance: none;
        cursor: pointer;
        padding-right: 3rem;
    }

    .input-icon-modern {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 1rem;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .input-wrapper-modern:focus-within .input-icon-modern {
        color: var(--primary-color);
        transform: translateY(-50%) scale(1.05);
    }

    .textarea-icon {
        top: 1.2rem;
        transform: none;
    }

    .select-arrow {
        pointer-events: none;
    }

    .option-bullet {
        color: var(--primary-color);
        font-size: 0.6rem;
    }

    .options-container {
        margin-bottom: 1rem;
    }

    .option-item {
        margin-bottom: 1rem;
        position: relative;
        animation: optionSlideIn 0.3s ease-out;
    }

    @keyframes optionSlideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .btn-add-option {
        background: var(--bg-tertiary);
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        cursor: pointer;
    }

    .btn-add-option:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    .error-message-modern {
        background: rgba(239, 68, 68, 0.1);
        border: 2px solid rgba(239, 68, 68, 0.2);
        border-radius: 12px;
        padding: 1rem 1.2rem;
        color: var(--danger-color);
        font-weight: 600;
        margin-top: 1rem;
        animation: errorSlide 0.3s ease-out;
        font-family: 'Poppins', sans-serif;
    }

    @keyframes errorSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modern-footer {
        background: var(--bg-secondary);
        border-top: 1px solid var(--border-color);
        padding: 1.5rem 2.5rem;
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .btn-secondary-modern {
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .btn-secondary-modern:hover {
        background: var(--bg-tertiary);
        border-color: var(--text-muted);
        color: var(--text-primary);
        transform: translateY(-2px);
    }

    .btn-primary-modern {
        background: var(--success-gradient);
        border: none;
        border-radius: 12px;
        padding: 0.8rem 2rem;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn-primary-modern:hover::before {
        left: 100%;
    }

    .btn-primary-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(16, 185, 129, 0.4);
    }

    /* Loading state for submit button */
    .btn-loading-modern {
        position: relative;
        color: transparent !important;
    }

    .btn-loading-modern::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
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

    /* Modern Toast */
    .modern-toast {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 12px;
        box-shadow: var(--shadow-lg);
        min-width: 300px;
    }

    .toast-icon {
        width: 40px;
        height: 40px;
        background: var(--success-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
    }

    .modern-toast .toast-body {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--text-primary) !important;
        padding: 1rem 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modern-header {
            padding: 1.5rem 1.5rem;
        }

        .modern-body {
            padding: 2rem 1.5rem;
        }

        .modern-footer {
            padding: 1.5rem;
            flex-direction: column;
        }

        .btn-primary-modern,
        .btn-secondary-modern {
            width: 100%;
            justify-content: center;
        }
    }
</style>
