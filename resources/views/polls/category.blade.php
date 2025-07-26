@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary mb-4">Polls in Selected Category</h2>

    <div class="row" id="pollListByCategory">
        <div class="text-center">Loading polls...</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const categoryId = '{{ $categoryId }}';
        $.ajax({
            url: `/api/polls/category/${categoryId}`,
            method: 'GET',
            success: function(response) {
                const container = $('#pollListByCategory');
                container.empty();

                if (response.length === 0) {
                    container.html('<div class="alert alert-info">No polls found in this category.</div>');
                    return;
                }

                response.forEach(poll => {
                    const html = `
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow-sm h-100 border-start border-4 border-primary">
                                <div class="card-body">
                                    <h5 class="card-title">${poll.question}</h5>
                                    <p class="card-text text-muted">Category: <strong>${poll.category.name}</strong></p>
                                    <p class="card-text">
                                        <small class="text-muted">Created: ${poll.created_diff}</small>
                                    </p>
                                    <a href="/polls/view/${poll.public_id}" class="btn btn-outline-primary btn-sm">View & Vote</a>
                                </div>
                            </div>
                        </div>`;
                    container.append(html);
                });
            },
            error: function() {
                $('#pollListByCategory').html('<div class="alert alert-danger">Failed to load polls.</div>');
            }
        });
    });
</script>
@endpush