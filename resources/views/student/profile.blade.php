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
                    <a class="nav-link" href="/home" active>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/document-request">Request a Document</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/document-request/history">Request History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about-us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('profile.index') }}">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container signup-container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card signup-card">
                    <div class="card-body">
                        @if (session('profile-updated'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('profile-updated') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form class="signup-form" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <h3 class="signup-title">Profile Customization</h3>
                            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                            <!-- Personal Information -->
                            <h5 class="category-label">Personal Information</h5>
                            <div class="form-row">
                                <!-- First Name -->
                                <div class="form-group col-md-4">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ $user->first_name }}">
                                </div>
                                <!-- Middle Name -->
                                <div class="form-group col-md-4">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name"
                                        value="{{ $user->middle_name }}">
                                </div>
                                <!-- Last Name -->
                                <div class="form-group col-md-4">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ $user->last_name }}">
                                </div>
                            </div>

                            <!-- Date of Birth -->
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        value="{{ $user->date_of_birth }}">
                                </div>
                                <!-- Gender -->
                                <div class="form-group col-md-4">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>

                                <!-- Contact Number -->
                                <div class="form-group col-md-4">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                                        value="{{ $user->contact_number }}">
                                </div>
                            </div>

                            <!-- Complete Address -->
                            <div class="form-group">
                                <label for="complete_address">Complete Address</label>
                                <textarea class="form-control" id="complete_address" name="complete_address" rows="3">{{ $user->complete_address }}</textarea>
                            </div>

                            <!-- Academic Information -->
                            <h5 class="category-label">Academic Information</h5>

                            @if ($user->student_type === 'current')
                                <!-- Current Student -->
                                <h6 class="category-label">Current Student</h6>
                                <div class="form-row">
                                    <!-- Grade Level/Year -->
                                    <div class="form-group col-md-4">
                                        <label for="grade_level">Grade Level/Year</label>
                                        <select class="form-control" id="grade_level" name="grade_level">
                                            <option value="7" {{ $user->grade_level == 7 ? 'selected' : '' }}>Grade 7
                                            </option>
                                            <option value="8" {{ $user->grade_level == 8 ? 'selected' : '' }}>Grade 8
                                            </option>
                                            <option value="9" {{ $user->grade_level == 9 ? 'selected' : '' }}>Grade 9
                                            </option>
                                            <option value="10" {{ $user->grade_level == 10 ? 'selected' : '' }}>Grade
                                                10</option>
                                            <option value="11" {{ $user->grade_level == 11 ? 'selected' : '' }}>Grade
                                                11</option>
                                            <option value="12" {{ $user->grade_level == 12 ? 'selected' : '' }}>Grade
                                                12</option>
                                        </select>
                                    </div>

                                    <!-- Section/Strand -->
                                    <div class="form-group col-md-4">
                                        <label for="section">Section/Strand</label>
                                        <input type="text" class="form-control" id="section" name="section"
                                            value="{{ $user->section }}">
                                    </div>

                                    <!-- Learner Reference Number (LRN) -->
                                    <div class="form-group col-md-4">
                                        <label for="learner_reference_number">Learner Reference Number (LRN)</label>
                                        <input type="text" class="form-control" id="learner_reference_number"
                                            name="learner_reference_number"
                                            value="{{ $user->learner_reference_number }}">
                                    </div>
                                </div>
                            @elseif($user->student_type === 'alumni')
                                <!-- Alumni -->
                                <h6 class="category-label">Alumni</h6>
                                <div class="form-row">
                                    <!-- Graduation Year -->
                                    <div class="form-group col-md-6">
                                        <label for="graduation_year">Graduation Year</label>
                                        <input type="text" class="form-control" id="graduation_year"
                                            name="graduation_year" value="{{ $user->graduation_year }}">
                                    </div>

                                    <!-- Last Grade Attended -->
                                    <div class="form-group col-md-6">
                                        <label for="last_grade_attended">Last Grade Attended</label>
                                        <input type="text" class="form-control" id="last_grade_attended"
                                            name="last_grade_attended" value="{{ $user->last_grade_attended }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Adviser's Name -->
                                    <div class="form-group col-md-6">
                                        <label for="adviser_name">Adviser's Name from the last year attended</label>
                                        <input type="text" class="form-control" id="adviser_name" name="adviser_name"
                                            value="{{ $user->adviser_name }}">
                                    </div>

                                    <!-- Adviser's Section -->
                                    <div class="form-group col-md-6">
                                        <label for="adviser_section">Section</label>
                                        <input type="text" class="form-control" id="adviser_section"
                                            name="adviser_section" value="{{ $user->adviser_section }}">
                                    </div>
                                </div>
                            @endif



                            <!-- Account Information -->
                            <h5 class="category-label">Account Information</h5>
                            <div class="form-row">
                                <!-- Email Address -->
                                <div class="form-group col-md-4">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}">
                                </div>

                                <!-- Password -->
                                <div class="form-group col-md-4">
                                    <label for="password">Current Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter new password">
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group col-md-4">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm new password">
                                </div>
                            </div>


                            <!-- Guardian Information -->
                            <h5 class="category-label">Guardian's Information</h5>
                            <div class="form-row">
                                <!-- Guardian's Full Name -->
                                <div class="form-group col-md-6">
                                    <label for="guardian_full_name">Guardian's Full Name</label>
                                    <input type="text" class="form-control" id="guardian_full_name"
                                        name="guardian_full_name" value="{{ $user->guardian_full_name }}">
                                </div>
                                <!-- Guardian's Contact Number -->
                                <div class="form-group col-md-6">
                                    <label for="guardian_contact_number">Guardian's Contact Number</label>
                                    <input type="text" class="form-control" id="guardian_contact_number"
                                        name="guardian_contact_number" value="{{ $user->guardian_contact_number }}">
                                </div>
                            </div>

                            <div class="alert alert-info" role="alert">
                                Your data is treated with confidentiality and is protected under the Data Privacy Act of
                                2012 (RA No. 10173).
                            </div>

                            <!-- Update Profile Button -->
                            <button type="submit" class="common-button btn-primary btn-block">Update Profile</button><br>
                            <a href="/logout" class="common-button secondary-button btn-block">Logout</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
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
