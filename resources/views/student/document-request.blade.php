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
                <a class="nav-link active" href="/document-request">Request a Document</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/document-request/history">Request History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about-us">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.index') }}">
                    <i class="fas fa-user"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<form id="document-request-form" action="{{ route('document-request.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container signup-container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card signup-card">
                    <div class="card-body">
                        <form class="signup-form" method="POST" action="/register">
                            <h3 class="request-title">Document Request Form</h3>
                            @csrf

                            <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                            <h5 class="category-label">Requirements</h5> <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="document_id">Document Type</label>
                                        <select class="form-control" name="document_id" id="document_id">
                                            @foreach($documents as $document)
                                                <option value="{{ $document->document_id }}">{{ $document->document_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="number_of_copies">Number of Copies</label>
                                        <input class="form-control" type="number" name="number_of_copies" id="number_of_copies">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="purpose">Purpose of Request</label>
                                        <select class="form-control" id="purpose" name="purpose" class="form-control" required>
                                            <option value="" disabled selected>Select Purpose</option>
                                            @foreach ($purposes as $category => $purposeList)
                                                <optgroup label="{{ $category }}">
                                                    @foreach ($purposeList as $purpose)
                                                        <option value="{{ $purpose }}">{{ $purpose }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="id_picture">Learner's ID Picture</label>
                                        <input class="form-control" type="file" name="id_picture" id="id_picture" accept="image/*">
                                    </div>
                                    
                                </div>
                            <div class="alert alert-info" role="alert">
                                Your data is treated with confidentiality and is protected under the Data Privacy Act of
                                2012 (RA No. 10173).
                            </div>

                            <button type="submit" id="submit-button" class="common-button btn-primary btn-block">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
