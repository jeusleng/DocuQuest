<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SFHS Admin - Request Details</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Welcome, Admin!</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Document Requests</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.pending') }}">Pending Requests</a>
                        <a class="collapse-item" href="{{ route('admin.approved') }}">Approved Requests</a>
                        <a class="collapse-item" href="cards.html">Declined Requests</a>
                        <a class="collapse-item" href="cards.html">Completed Requests</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Appointments</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.upcoming') }}">Upcoming</a>
                        <a class="collapse-item" href="{{ route('admin.completed') }}">Completed</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users Management</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">SFHS Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('images/undraw_profile.svg') }}">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-0 text-gray-800 text-center"
                        style="color: #c53f3f !important; font-weight: bold;">Request Details</h1><br>

                    <div class="row">

                        <div class="col-lg-15">

                            <form method="post"
                                action="{{ route('admin.update-pending', $documentRequest->document_request_id) }}">
                                <div class="row justify-content-center">
                                    @csrf
                                    <div class="col-md-11">
                                        <div class="card history-card">
                                            <div class="card-body overflow-auto">
                                                <!-- Student Information -->

                                                <div class="mb-4">
                                                    <h5 class="category-label">Student Information</h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="student_name">Name</label>
                                                            <input type="text" class="form-control"
                                                                id="student_name" name="student_name"
                                                                value="{{ $student->first_name }} {{ $student->last_name }}"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="contact_number">Contact Number</label>
                                                            <input type="text" class="form-control"
                                                                id="contact_number" name="contact_number"
                                                                value="{{ $student->contact_number }}" disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="gender">Gender</label>
                                                            <input type="text" class="form-control" id="gender"
                                                                name="gender" value="{{ $student->gender }}"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="date_of_birth">Date of Birth</label>
                                                            <input type="text" class="form-control"
                                                                id="date_of_birth" name="date_of_birth"
                                                                value="{{ $student->date_of_birth }}" disabled>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="complete_address">Address</label>
                                                            <input type="text" class="form-control"
                                                                id="complete_address" name="complete_address"
                                                                value="{{ $student->complete_address }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="grade_level">Grade Level</label>
                                                            <input type="text" class="form-control"
                                                                id="grade_level" name="grade_level"
                                                                value="{{ $student->grade_level }}" disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="section">Section/Strand</label>
                                                            <input type="text" class="form-control" id="section"
                                                                name="section" value="{{ $student->section }}"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control" id="email"
                                                                name="email" value="{{ $student->email }}"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                <!-- Document Request Details -->
                                                <div class="mb-4">
                                                    <h5 class="category-label">Document Request Details</h5>
                                                    <div class="row">
                                                        <!-- Document Type and Purpose of Request -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="document_type">Document Type</label>
                                                            <input type="text" class="form-control"
                                                                id="document_type" name="document_type"
                                                                value="{{ $documentRequest->documents->document_type }}"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="purpose_of_request">Purpose of Request</label>
                                                            <input type="text" class="form-control"
                                                                id="purpose_of_request" name="purpose_of_request"
                                                                value="{{ $documentRequest->purpose }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- Number of Copies and Additional Requirements -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="number_of_copies">Number of Copies</label>
                                                            <input type="text" class="form-control"
                                                                id="number_of_copies" name="number_of_copies"
                                                                value="{{ $documentRequest->number_of_copies }}"
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="additional_requirements">Additional
                                                                Requirements</label>
                                                            <input type="text" class="form-control"
                                                                id="additional_requirements"
                                                                name="additional_requirements"
                                                                value="{{ $documentRequest->id_picture }}" disabled>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <h5 class="category-label">Acknowledgement Receipt</h5>
                                                    <div class="row">
                                                        <!-- Document Type and Purpose of Request -->
                                                        <div class="col-md-12 mb-3">
                                                            <label for="document_type">Acknowledgement Receipt</label>
                                                            @if ($documentRequest->acknowledgment_receipt)
                                                                <input type="text" class="form-control"
                                                                    id="document_type" name="document_type"
                                                                    value="{{ $documentRequest->acknowledgment_receipt }}"
                                                                    disabled>
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    id="document_type" name="document_type"
                                                                    value="Student did not upload acknowledgment receipt yet."
                                                                    disabled>
                                                            @endif
                                                        </div>
                                                    </div>



                                                    <br>
                                                    <h5 class="category-label">Action</h5>
                                                    <div class="row">
                                                        <!-- Request Status, Appointment Date, and Appointment Time -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="request_status">Request Status</label>
                                                            <!-- Custom-styled Dropdown for Request Status -->
                                                            <select class="form-select form-control"
                                                                id="request_status" name="request_status">
                                                                <option value="Pending"
                                                                    style="color: rgb(255, 157, 0);"
                                                                    {{ $documentRequest->request_status == 'Pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="Approved"
                                                                    style="color: rgb(28, 112, 28);"
                                                                    {{ $documentRequest->request_status == 'Approved' ? 'selected' : '' }}>
                                                                    Approved</option>
                                                                <option value="Declined"
                                                                    style="color: rgb(195, 46, 46);"
                                                                    {{ $documentRequest->request_status == 'Declined' ? 'selected' : '' }}>
                                                                    Declined</option>
                                                            </select>

                                                        </div>
                                                        <!-- Appointment Date and Time -->
                                                        <div class="col-md-6 mb-3">
                                                            <label for="appointment_date_time">Appointment Date and
                                                                Time</label>
                                                            <input type="datetime-local" class="form-control"
                                                                id="appointment_date_time"
                                                                name="appointment_date_time"
                                                                value="{{ $documentRequest->appointment_date_time? \Carbon\Carbon::parse($documentRequest->appointment_date_time)->timezone('UTC')->format('Y-m-d\TH:i'): '' }}">
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Update Button -->
                                            <div class="text-center"
                                                style="margin-top: -30px; margin-bottom: 30px; margin-left: 20px; margin-right: 20px">
                                                <button type="submit"
                                                    class="common-button btn-primary btn-block">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>






                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vendor scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Additional scripts -->
    <script>
        // Function to format the datetime input based on the selected AM/PM
        function updateDateTimeFormat() {
            const datetimeInput = document.getElementById('appointment_date_time');
            const selectedDatetime = datetimeInput.value;

            if (selectedDatetime) {
                const datetimeComponents = selectedDatetime.split('T');
                const date = datetimeComponents[0];
                const time = datetimeComponents[1].substring(0, 5);

                datetimeInput.value = `${date}T${time}`;
            }
        }
    </script>

</body>

</html>
