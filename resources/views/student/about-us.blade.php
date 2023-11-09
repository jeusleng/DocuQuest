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
                <a class="nav-link" href="/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/document-request">Request a Document</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/document-request/history">Request History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/about-us">About Us</a>
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
            <!-- First row with text and image -->
            <div class="col-md-6">
                <h2 class="about">About Us</h2>
                <p>
                    Welcome to DocuQuest, your one-stop solution for document requests. Our website simplifies the process of requesting important documents by providing a convenient and user-friendly platform.
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/welcome.png') }}" alt="Welcome Image" class="img-fluid">
            </div>

            <!-- Second row with image and text -->
            <div class="col-md-6">
                <img src="{{ asset('images/success.png') }}" alt="Success Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2 class="about">What We Do</h2>
                <p>
                    What we do is simple. At DocuQuest, we bridge the gap between students and alumni of San Felipe High School, offering a seamless and convenient platform for requesting a wide range of essential documents. Our user-friendly service caters to your diverse needs, whether you're seeking academic records, legal documents, or personal records. <br><br>We understand the importance of quick and hassle-free access to these documents, and our mission is to make the entire process efficient and stress-free. By providing a secure and confidential environment, we ensure that your sensitive information is handled with the utmost care. Furthermore, we offer transparent request tracking, keeping you informed every step of the way. With DocuQuest, your document requests are in safe hands, and your satisfaction is our top priority
                </p>
            </div>
        </div>
        <br>
        <h2 class="about text-center">Why use DocuQuest?</h2>
        <!-- Benefits in cards -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Efficient Document Requests</h5>
                        <p class="card-text">DocuQuest provides an efficient and streamlined document request process, saving you time and effort.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Quick Access to Important Records</h5>
                        <p class="card-text">You have quick access to your important records without the hassle of long waiting times.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Secure Handling of Your Information</h5>
                        <p class="card-text">We prioritize the security and confidentiality of your sensitive information throughout the request process.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transparent Request Tracking</h5>
                        <p class="card-text">Track the status of your request transparently, ensuring you're always in the know about its progress.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
