@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-3">
                    <div class="card-header bg-success text-white">Register</div>
                    <div class="card-body">
                        <form id="registerForm">
                            @csrf
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control" required />
                            </div>
                            <div id="register-error" class="text-danger mb-2"></div>
                            <button type="submit" class="btn btn-success w-100">Register</button>
                            <p class="text-center mt-3">
                                Already have an account? <a href="{{ route('login') }}">Login</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                $('#register-error').text('');
                const formData = $(this).serialize();

                $.ajax({
                    url: '/api/register',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        localStorage.setItem('access_token', response.access_token);
                        window.location.href =
                        '/dashboard'; // Redirect after successful registration
                    },
                    error: function(xhr) {
                        let message = 'Registration failed. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        $('#register-error').text(message);
                    }
                });
            });
        });
    </script>
@endpush
