@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div id="poll-area" class="text-center">
            <h2 id="poll-question" class="mb-3">Loading...</h2>
            <p id="poll-description" class="text-muted mb-4"></p>

            <div id="options-container" class="d-grid gap-2 col-6 mx-auto"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const publicId = "{{ $public_id }}";
        const baseUrl = "{{ url('/') }}";
        const csrfToken = "{{ csrf_token() }}";

        $(document).ready(function() {
            // Load Poll Data
            $.ajax({
                url: `${baseUrl}/api/polls/public/${publicId}`,
                method: 'GET',
                success: function(data) {
                    if (data.error) return alert(data.error);

                    $('#poll-question').text(data.poll.question);
                    $('#poll-description').text(data.poll.description);

                    const container = $('#options-container');
                    container.empty();

                    console.log("data", data);

                    if (data.has_voted) {
                        loadResults(publicId); // If already voted, show results directly
                    } else {
                        data.options.forEach(opt => {
                            const button = $(`
                                <button class="btn btn-outline-primary option-button w-100 mb-2" data-option-id="${opt.id}">
                                    ${opt.text}
                                </button>
                            `);
                            container.append(button);
                        });

                        $('.option-button').on('click', function() {
                            const optionId = $(this).data('option-id');

                            $.ajax({
                                url: `${baseUrl}/api/polls/${publicId}/vote`,
                                method: 'POST',

                                data: {
                                    option_id: optionId
                                },
                                success: function(res) {
                                    if (res.error) return alert(res.error);
                                    showResults(res
                                        .results); // Show new result after vote
                                },
                                error: function(err) {
                                    alert("Vote failed. Try again.");
                                    console.error(err.responseText);
                                }
                            });
                        });
                    }

                },
                error: function() {
                    alert("Failed to load poll.");
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

                results.forEach(r => {
                    let percent = totalVotes > 0 ? Math.round((r.votes / totalVotes) * 100) : 0;

                    const resultRow = $(`
                        <div class="mb-3 text-start">
                            <strong>${r.option}</strong>
                            <div class="progress mt-1">
                                <div class="progress-bar" role="progressbar" style="width: ${percent}%;">
                                    ${percent}%
                                </div>
                            </div>
                        </div>
                    `);
                    container.append(resultRow);
                });
            }
        });
    </script>
@endpush
