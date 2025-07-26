@forelse($polls as $poll)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card shadow-sm h-100 border-start border-4 border-primary poll-card"
            data-public-id="{{ $poll->public_id }}" style="cursor: pointer;">
            <div class="card-body">
                <h5 class="card-title">{{ $poll->question }}</h5>
                <p class="card-text text-muted">Category: <strong>{{ $poll->category->name }}</strong></p>
                <p class="card-text">
                    <small class="text-muted">Created: {{ $poll->created_at->diffForHumans() }}</small>
                </p>
                <div class="d-flex justify-content-between mt-3">
                    <span class="badge bg-info text-dark">{{ $poll->votes_count }} Votes</span>
                    <small class="text-primary fw-bold">Click to View</small>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-info">No polls found.</div>
    </div>
@endforelse
