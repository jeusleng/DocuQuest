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
                <a class="nav-link active" href="#">Request History</a>
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
<div class="container signup-container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card history-card">
                <div class="card-body">
                    <h3 class="request-title">Document Request History</h3>
                    <table class="table table-bordered" id="request-history-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Document Type</th>
                                <th>Date Requested</th>
                                <th>Appointment Date<br>and Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp
                            @foreach ($documentRequests as $documentRequest)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $documentRequest->documents->document_type }}</td>
                                <td>{{ $documentRequest->created_at }}</td>
                                <td class="{{ $documentRequest->appointment_date_time == 'Not yet specified' ? 'text-green' : 'text-yellow' }}">
                                    {{ $documentRequest->appointment_date_time ?? 'Not yet specified' }}
                                </td>                                
                                
                                <td class="{{ getStatusClass($documentRequest->request_status) }}">
                                    {{ $documentRequest->request_status }}
                                </td>
                                
                                <td>
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <form method="POST" action="{{ route('document-request.cancel', $documentRequest) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger cancel-request" onclick="confirmCancellation(this)">Cancel</button>
                                            </form>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-primary blue-background">View</button>
                                        </div>
                                    </div>
                                </td>
                                
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@php
function getStatusClass($status) {
    switch ($status) {
        case 'Pending':
            return 'status-pending';
        case 'Approved':
            return 'status-approved';
        case 'Declined':
            return 'status-declined';
        case 'Completed':
            return 'status-completed';
        default:
            return '';
    }
}
@endphp