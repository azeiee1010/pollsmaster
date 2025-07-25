@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white">Login</div>
                    <div class="card-body">
                        <form id="loginForm">
                            @csrf
                            <div class="mb-3">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required />
                            </div>
                            <div id="login-error" class="text-danger mb-2"></div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                            <p class="text-center mt-3">
                                Don't have an account? <a href="{{ route('register') }}">Register</a>
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
            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default behavior
                $('#login-error').text('');

                const form = $(this);
                const data = form.serialize();

                $.ajax({
                    url: '/api/login',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        localStorage.setItem('access_token', response.access_token);
                        window.location.href = '/dashboard';
                    },
                    error: function(xhr) {
                        let message = 'Login failed. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        $('#login-error').text(message);
                    }
                });
            });
        });
    </script>
@endpush
