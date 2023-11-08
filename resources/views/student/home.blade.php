@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light" style="margin-left: 120px; padding: 0; margin-right: 120px;">
    <a class="navbar-brand" href="/home">
        <img src="{{ asset('images/logo.png') }}" alt="DocuQuest" width="120">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link active" href="/home" active>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/document-request">Request a Document</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/document-request/history">Request History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-user"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>



<div class="container mt-4">
    <div class="row" style="margin-top: 90px;">
        <div class="col-md-6">
            <div class="text-left mb-4">
                <h2>Welcome to DocuQuest,</h2>
                <h1 class="display-3 font-weight-bolder">{{ session('first_name') }}!</h1>
                <h4>Request a document now to San Felipe High School to streamline your document requests and appointments.</h4>
            </div>

            <div class="mb-4">
                <a href="/logout" class="common-button primary-button">LOGOUT</a>
            </div>
        </div>

        <div class="col-md-6">
            <img src="{{ asset('images/welcome.png') }}" alt="Welcome Image" class="img-fluid">
        </div>
    </div>
</div>

<div class="request-process-section">
    <h2 class="text-center">Request Process</h2><br>
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="request-card">
                <img src="{{ asset('images/card1.png') }}" alt="Card 1">
                <h4>Create an Account and Login</h4>
                <p>Sign up for an account. Your login details give you access.</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="request-card">
                <img src="{{ asset('images/card2.png') }}" alt="Card 2">
                <h4>Request a Document</h4>
                <p>Go to <span style="font-weight: bold">“Request a Document”</span> menu. Fill out the form with document details and upload required files.</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="request-card">
                <img src="{{ asset('images/card3.png') }}" alt="Card 3">
                <h4>Track Your Request</h4>
                <p>Go to <span style="font-weight: bold">“Request Status”</span> to check if your request is pending, approved, or declined. See your appointment date as well.</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="request-card">
                <img src="{{ asset('images/card4.png') }}" alt="Card 4">
                <h4>Wait for Your Schedule</h4>
                <p>Staff reviews requests and sets an appointment date for approved requests.</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="request-card">
                <img src="{{ asset('images/card5.png') }}" alt="Card 5">
                <h4>Pickup Your Document</h4>
                <p>On the scheduled date, visit the school office as per your appointment. Present any valid IDs for verification.</p>
            </div>
        </div>
    </div>
</div>

@endsection
