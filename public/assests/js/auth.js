$(document).ready(function () {
    // REGISTER
    $('#registerForm').on('submit', function (e) {
        e.preventDefault();
        const data = {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val(),
        };

        $.post('/api/register', data)
            .done(function (res) {
                localStorage.setItem('access_token', res.token);
                window.location.href = '/dashboard'; // redirect to home
            })
            .fail(function (xhr) {
                const err = xhr.responseJSON?.message || 'Registration failed.';
                $('#register-error').text(err);
            });
    });
});
