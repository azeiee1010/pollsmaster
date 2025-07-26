<div class="col-md-6">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <h5 class="card-title">{{ $title }}</h5>
            <span class="badge bg-info text-dark">{{ $category }}</span>
            <p class="mt-2 mb-1"><strong>Votes:</strong> {{ $votes }}</p>
            <span class="badge {{ $status === 'Active' ? 'bg-success' : 'bg-secondary' }}">{{ $status }}</span>
        </div>
    </div>
</div>
