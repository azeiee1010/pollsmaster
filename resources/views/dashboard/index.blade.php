@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-primary">Welcome to PollsMaster</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createPollModal">+ New Poll</button>
        </div>

        <!-- Categories Section -->
        <div class="row mb-4">
            @foreach ($categories as $category)
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm category-card text-center p-3">
                        <h5>{{ $category->name }}</h5>
                        <button class="btn btn-outline-primary btn-sm mt-2 view-category-polls"
                            data-id="{{ $category->id }}">View Polls</button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Recent Polls Section -->
        <h5 class="text-secondary mb-3">Recent Polls</h5>
        <div class="row">
            @forelse($polls as $poll)
                <div class="col-md-6">
                    <div class="card mb-3 p-3 shadow-sm">
                        <h6 class="fw-bold">{{ $poll->title }}</h6>
                        <p class="mb-1 text-muted">{{ $poll->description }}</p>
                        <span class="badge bg-info">{{ $poll->category->name ?? 'No Category' }}</span>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No polls available.</p>
                </div>
            @endforelse
        </div>
    </div>

    @include('dashboard.partials.create_poll_modal')
@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endpush
