@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light" style="margin-left: 120px; padding: 0; margin-right: 120px;">
        <a class="navbar-brand" href="/home">
            <img src="{{ asset('images/logo.png') }}" alt="DocuQuest" width="120">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
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
                                @forelse ($documentRequests as $documentRequest)
                                    <tr>
                                        <td class="tdClass">{{ $counter++ }}</td>
                                        <td class="tdClass">{{ $documentRequest->documents->document_type }}</td>
                                        <td class="tdClass">
                                            {{ $documentRequest->created_at ? \Carbon\Carbon::parse($documentRequest->created_at)->format('M d, Y h:i A') : '' }}
                                        </td>
                                        <td
                                            class="{{ $documentRequest->appointment_date_time == null ? 'status-pending' : 'status-approved' }}">
                                            {{ $documentRequest->appointment_date_time ? \Carbon\Carbon::parse($documentRequest->appointment_date_time)->format('M d, Y h:i A') : 'Not yet specified' }}
                                        </td>
                                        <td class="{{ getStatusClass($documentRequest->request_status) }}">
                                            {{ $documentRequest->request_status }}
                                        </td>
                                        <td>
                                            <div class="btn-toolbar">
                                                <div class="btn-group">
                                                    <form id="cancel-form-{{ $documentRequest->id }}" method="POST"
                                                        action="{{ route('document-request.cancel', $documentRequest) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if ($documentRequest->request_status === 'Pending' || $documentRequest->request_status === 'Declined')
                                                        <button type="button" class="btn btn-primary red-background"
                                                            onclick="confirmCancellation(this)">Cancel</button>
                                                            @endif
                                                    </form>
                                                </div>
                                                <div class="btn-group">
                                                    @if ($documentRequest->request_status === 'Pending' || $documentRequest->request_status === 'Declined' || $documentRequest->request_status === 'Approved' || $documentRequest->request_status === 'Completed')
                                                        <button class="btn btn-primary blue-background" data-toggle="modal"
                                                            data-target="#documentRequestModal{{ $documentRequest->document_request_id }}"
                                                            onclick="openModal({{ $documentRequest->document_request_id }})">View</button>
                                                    @endif
                                                </div>
                                                <div class="btn-group">
                                                    @if ($documentRequest->request_status === 'Pending' || $documentRequest->request_status === 'Declined')
                                                        <a class="btn btn-primary yellow-background"
                                                            href="{{ route('document-request.edit', $documentRequest) }}">Edit</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" style="color: var(--secondary-color);">No records to show in the request history at the moment.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for confirmation and modal -->
    <script>
        function confirmCancellation(button) {
            if (confirm("Are you sure you want to cancel this request?")) {
                // If the user confirms, submit the form
                button.closest('form').submit();
            }
        }

        // Function to open the correct modal based on the clicked button
        function openModal(documentRequestId) {
            $('#documentRequestModal' + documentRequestId).modal('show');
        }

        function closeModal() {
            $('.modal').modal('hide');
        }
    </script>

    @php
        function getStatusClass($status)
        {
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

    @foreach ($documentRequests as $documentRequest)
        <!-- The modal -->
        <div class="modal fade" id="documentRequestModal{{ $documentRequest->document_request_id }}" tabindex="-1"
            role="dialog" aria-labelledby="documentRequestModal{{ $documentRequest->document_request_id }}Label"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold"
                            id="documentRequestModal{{ $documentRequest->document_request_id }}Label">
                            {{ $documentRequest->documents->document_type }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="word-wrap: break-word;">
                        <div class="row">
                            <div class="col-6">
                                <p class="textLabel"><strong>Request Status:</strong> <span
                                        class="{{ getStatusClass($documentRequest->request_status) }}">{{ $documentRequest->request_status }}</span>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="textLabxel"><strong>Date & Time Requested:</strong>
                                    {{ $documentRequest->created_at ? \Carbon\Carbon::parse($documentRequest->created_at)->format('M d, Y h:i A') : '' }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <p class="textLabel"><strong>Appointment Date and Time:</strong></p>
                                @if ($documentRequest->appointment_date_time)
                                    <p>
                                        Kindly visit the office at the specified date and time:
                                        <span
                                            class="status-approved">{{ \Carbon\Carbon::parse($documentRequest->appointment_date_time)->format('M d, Y h:i A') }}</span>.
                                        If you are a current student at SFHS, please bring your learner's ID. For alumni,
                                        any valid government IDs are accepted. In case you are unable to pickup the
                                        requested
                                        documents personally and wish for an authorized representative to receive them,
                                        please prepare an authorization letter along with three photocopies of your
                                        learner's ID or valid IDs and any valid IDs from the authorized representative.
                                    </p>
                                @else
                                    <p>Not yet specified. This will be updated once your request is approved.</p>
                                @endif
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <p class="textLabel"><strong>Number of Copies Requested:</strong>
                                    {{ $documentRequest->number_of_copies }}</p>
                            </div>
                            <div class="col-6">
                                <p class="textLabel"><strong>Additional Requirements Uploaded:</strong>
                                    @if ($documentRequest->id_picture)
                                        <a class="btn btn-primary" style="font-size: 12px" href="{{ asset('storage/' . $documentRequest->id_picture) }}" target="_blank">
                                            View Uploaded ID Picture
                                        </a>
                                    @else
                                        None
                                    @endif
                                </p>
                            </div>
                            
                            
                        </div>

                        @if ($documentRequest->request_status === 'Approved')
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    @if ($documentRequest->acknowledgment_receipt)
                                        <p class="textLabel"><strong>Acknowledgment Receipt:</strong></p>
                                        <a class="status-approved" style="font-weight: normal"
                                            href="{{ asset($documentRequest->acknowledgment_receipt) }}" target="_blank">
                                            {{ $documentRequest->acknowledgment_receipt }}
                                        </a>
                                    @else
                                        <form method="POST"
                                            action="{{ route('document-request.uploadReceipt', $documentRequest) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <p class="textLabel"><strong>Upload Acknowledgment Receipt:</strong></p>
                                            <input type="file" name="acknowledgment_receipt" accept=".pdf, .jpg, .png"
                                                required>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="closeModal()">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
