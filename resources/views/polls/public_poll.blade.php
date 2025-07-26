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

                    //     data.options.forEach(opt => {
                    //         const button = $(`
                //             <button class="btn btn-outline-primary option-button w-100 mb-2" data-option-id="${opt.id}">
                //                 ${opt.text}
                //             </button>
                //         `);

                    //         container.append(button);
                    //     });

                    //     // Handle vote
                    //     $('.option-button').on('click', function() {
                    //         const optionId = $(this).data('option-id');

                    //         $.ajax({
                    //             url: `${baseUrl}/api/polls/${publicId}/vote`,
                    //             method: 'POST',
                    //             headers: {
                    //                 'X-CSRF-TOKEN': csrfToken
                    //             },
                    //             data: {
                    //                 option_id: optionId
                    //             },
                    //             success: function(res) {
                    //                 if (res.error) return alert(res.error);
                    //                 loadResults(publicId);
                    //             },
                    //             error: function(err) {
                    //                 alert("Vote failed. Try again.");
                    //                 console.error(err.responseText);
                    //             }
                    //         });
                    //     });
                    // },




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
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
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
































{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div id="poll-area" class="text-center">
            <h2 id="poll-question">Loading...</h2>
            <p id="poll-description"></p>

            <div id="options-container" class="mt-4"></div>

            <div id="results" class="mt-4 d-none">
                <h4>Results</h4>
                <ul id="results-list" class="list-group"></ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const publicId = "{{ $public_id }}";
        const baseUrl = "{{ url('/') }}";

        document.addEventListener("DOMContentLoaded", function() {
            fetch(`${baseUrl}/api/polls/public/${publicId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) return alert(data.error);
                    console.log("data", data);
                    document.getElementById('poll-question').textContent = data.poll.question;
                    document.getElementById('poll-description').textContent = data.poll.description;

                    const container = document.getElementById('options-container');

                    data.options.forEach(opt => {
                        const btn = document.createElement('button');
                        btn.className = 'btn btn-outline-primary btn-block mb-2';
                        btn.textContent = opt.text;
                        btn.onclick = () => submitVote(data.poll.id, opt.id);
                        container.appendChild(btn);
                    });
                });

            function submitVote(pollId, optionId) {
                fetch(`${baseUrl}/api/votes`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            poll_id: pollId,
                            option_id: optionId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) return alert(data.error);

                        alert("Vote submitted!");
                        fetch(`${baseUrl}/api/polls/${pollId}/results`)
                            .then(res => res.json())
                            .then(resData => showResults(resData.results));
                    });
            }

            function showResults(results) {
                const resDiv = document.getElementById('results');
                const resList = document.getElementById('results-list');
                resDiv.classList.remove('d-none');
                resList.innerHTML = '';
                results.forEach(r => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item d-flex justify-content-between';
                    li.innerHTML = `<span>${r.option}</span><strong>${r.votes} votes</strong>`;
                    resList.appendChild(li);
                });

                // Hide voting buttons
                document.getElementById('options-container').innerHTML = '';
            }
        });
    </script>
@endpush --}}
