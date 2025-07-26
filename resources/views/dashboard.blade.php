@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Polls Dashboard</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createPollModal">
                + Create New Poll
            </button>
        </div>

        <!-- Category Filter -->
        <div class="mb-4">
            <select class="form-select w-auto" id="categoryFilter">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Recent Polls -->
        <div class="row" id="pollList">
            @forelse($polls as $poll)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100 border-start border-4 border-primary">
                        <div class="card-body">
                            <h5 class="card-title">{{ $poll->question }}</h5>
                            <p class="card-text text-muted">Category: <strong>{{ $poll->category->name }}</strong></p>
                            <p class="card-text">
                                <small class="text-muted">Created: {{ $poll->created_at->diffForHumans() }}</small>
                            </p>
                            <a href="{{ route('poll.show', $poll->id) }}" class="btn btn-outline-primary btn-sm">View &
                                Vote</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No polls found.</div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Create Poll Modal -->
    <div class="modal fade" id="createPollModal" tabindex="-1" aria-labelledby="createPollLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="createPollForm" class="modal-content">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="createPollLabel">Create New Poll</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="create-poll-error" class="text-danger mb-2"></div>
                    <div class="mb-3">
                        <label for="question" class="form-label">Poll Question</label>
                        <input type="text" name="question" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="optionsContainer">
                        <div class="mb-3">
                            <label class="form-label">Option 1</label>
                            <input type="text" name="options[]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Option 2</label>
                            <input type="text" name="options[]" class="form-control" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="addOption">+ Add Option</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create Poll</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
