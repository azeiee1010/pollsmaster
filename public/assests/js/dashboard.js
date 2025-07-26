$(document).ready(function () {
    $("#addOptionBtn").on("click", function () {
        $("#optionsWrapper").append(
            '<input type="text" name="options[]" class="form-control mb-2" placeholder="Another option" required>'
        );
    });

    $("#createPollForm").on("submit", function (e) {
        e.preventDefault();
        const data = $(this).serialize();

        $.ajax({
            url: "/api/polls", // Your API endpoint
            type: "POST",
            data: data,
            success: function (response) {
                $("#createPollModal").modal("hide");
                location.reload(); // Refresh to show new poll
            },
            error: function (xhr) {
                $("#create-poll-error").text(
                    xhr.responseJSON?.message || "Something went wrong"
                );
            },
        });
    });
});
