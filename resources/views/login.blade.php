@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light" style="margin-left: 120px; padding: 0; margin-right: 120px;">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('images/logo.png') }}" alt="DocuQuest" width="120">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-card">
                <div class="row">
                    <div class="col-md-6">
                        <form class="login-form" method="POST" action="/login">
                            @csrf
                            @method('POST')
                            <h3 class="login-title">Login</h3>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input placeholder="Enter your email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input placeholder="Enter your password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="common-button btn-primary btn-block">Login</button>
                        </form>
                        <p class="signup-text">Don't have an account yet? <a href="/registration">Sign Up here.</a></p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/login.png') }}" alt="Login Image" class="login-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('invalid-login'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Invalid email or password.',
            showConfirmButton: false,
            timer: 2500,
        });
    </script>
@elseif(session('register-success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Registration Successful.',
            showConfirmButton: false,
            timer: 2500,
        });
    </script>
@endif

@if(session('act-status-inactive'))
    <script>
        alert('Your account is inactive. Please contact the administrator.');
    </script>
@endif


<script>
    const passwordField = document.getElementById("pass-in");
    const visibilityButton = document.getElementById("visibilitiy-btn");

    visibilityButton.addEventListener("click", function() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            visibilityButton.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        } else {
            passwordField.type = "password";
            visibilityButton.innerHTML = '<i class="fa-solid fa-eye"></i>';
        }
    });
</script>
@endsection


