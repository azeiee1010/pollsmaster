alert("This is a code completion request. Please provide the code snippet to complete.");
(function () {
    const token = localStorage.getItem("access_token");
    const allowGuest = window.allowGuestPage || false;

    if (!token && !allowGuest) {
        window.location.href = "/login";
    }
})();
