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
                <a class="nav-link active" href="/document-request/history">Request History</a>
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
<form method="post" action="{{ route('document-request.update', ['documentRequest' => $documentRequest]) }}">
    @csrf
    @method('PUT')
    <div class="container signup-container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card signup-card">
                    <div class="card-body">

                            <h3 class="request-title">Edit Document Request Details</h3>
                            
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="document_id">Document Type</label>
                                        <select class="form-control" name="document_id" id="document_id">
                                            @foreach($documents as $document)
                                                <option value="{{ $document->document_id }}" {{ $documentRequest->document_id == $document->document_id ? 'selected' : '' }}>
                                                    {{ $document->document_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="number_of_copies">Number of Copies</label>
                                        <input class="form-control" type="number" name="number_of_copies" id="number_of_copies" value="{{ $documentRequest->number_of_copies }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="purpose">Purpose of Request</label>
                                        <select class="form-control" name="purpose" id="purpose">
                                            <option value="" disabled>Select Purpose</option>
                                            @foreach ($purposes as $category => $purposeList)
                                                <optgroup label="{{ $category }}">
                                                    @foreach ($purposeList as $purpose)
                                                        <option value="{{ $purpose }}" {{ $documentRequest->purpose == $purpose ? 'selected' : '' }}>
                                                            {{ $purpose }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="alert alert-info" role="alert">
                                Your data is treated with confidentiality and is protected under the Data Privacy Act of
                                2012 (RA No. 10173).
                            </div>

                            <button type="submit" class="common-button btn-primary btn-block">UPDATE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    </div>
@endsection
