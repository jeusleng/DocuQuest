    <nav class="navbar navbar-expand-lg navbar-light" style="margin-left: 120px; padding: 0; margin-right: 120px;">
        <a class="navbar-brand" href="/registration">
            <img src="{{ asset('images/logo.png') }}" alt="DocuQuest" width="120">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    @extends('layouts.app')

    @section('content')
        <div class="container signup-container">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card signup-card">
                        <div class="card-body">
                            @if (session('invalid-login'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('invalid-login') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form class="signup-form" method="POST" action="/register">
                                @csrf

                                <h3 class="signup-title">Sign Up</h3>

                                <div class="alert alert-info" role="alert">
                                    NOTE: Kindly provide your information and complete the form. For any sections that do
                                    not
                                    apply to you, you may use "N/A."
                                </div>

                                <!-- Personal Information -->
                                <h5 class="category-label">Personal Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            id="first_name" name="first_name" placeholder="Enter your first name"
                                            value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text"
                                            class="form-control @error('middle_name') is-invalid @enderror" id="middle_name"
                                            name="middle_name" placeholder="Enter your middle name"
                                            value="{{ old('middle_name') }}">
                                        @error('middle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for "last_name">Last Name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            id="last_name" name="last_name" placeholder="Enter your last name"
                                            value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date"
                                            class="form-control @error('date_of_birth') is-invalid @enderror"
                                            id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gender">Gender</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                                            name="gender">
                                            <option value="male" @if (old('gender') === 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if (old('gender') === 'female') selected @endif>Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text"
                                            class="form-control @error('contact_number') is-invalid @enderror"
                                            id="contact_number" name="contact_number"
                                            placeholder="Enter your contact number" value="{{ old('contact_number') }}">
                                        @error('contact_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="complete_address">Complete Address</label>
                                    <textarea class="form-control @error('complete_address') is-invalid @enderror" id="complete_address"
                                        name="complete_address" rows="3" placeholder="Zone/Sitio, Barangay, Town, Province, ZIP Code">{{ old('complete_address') }}</textarea>
                                    @error('complete_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Academic Information -->
                                <h5 class="category-label">Academic Information</h5>

                                <!-- Current Student -->
                                <h6 class="category-label">Current Student</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="grade_level">Grade Level/Year</label>
                                        <select class="form-control @error('grade_level') is-invalid @enderror"
                                            id="grade_level" name="grade_level">
                                            <option value="7" @if (old('grade_level') === '7') selected @endif>Grade
                                                7
                                            </option>
                                            <option value="8" @if (old('grade_level') === '8') selected @endif>Grade
                                                8
                                            </option>
                                            <option value="9" @if (old('grade_level') === '9') selected @endif>Grade
                                                9
                                            </option>
                                            <option value="10" @if (old('grade_level') === '10') selected @endif>Grade
                                                10
                                            </option>
                                            <option value="11" @if (old('grade_level') === '11') selected @endif>Grade
                                                11
                                            </option>
                                            <option value="12" @if (old('grade_level') === '12') selected @endif>Grade
                                                12
                                            </option>
                                        </select>
                                        @error('grade_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="section">Section/Strand</label>
                                        <input type="text" class="form-control @error('section') is-invalid @enderror"
                                            id="section" name="section" placeholder="Enter your section/strand"
                                            value="{{ old('section') }}">
                                        @error('section')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="learner_reference_number">Learner Reference Number (LRN)</label>
                                        <input type="text"
                                            class="form-control @error('learner_reference_number') is-invalid @enderror"
                                            id="learner_reference_number" name="learner_reference_number"
                                            placeholder="Enter your LRN" value="{{ old('learner_reference_number') }}">
                                        @error('learner_reference_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Alumni -->
                                <h6 class="category-label">Alumni</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="graduation_year">Graduation Year</label>
                                        <input type="text"
                                            class="form-control @error('graduation_year') is-invalid @enderror"
                                            id="graduation_year" name="graduation_year"
                                            placeholder="Enter your graduation year"
                                            value="{{ old('graduation_year') }}">
                                        @error('graduation_year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="last_grade_attended">Last Grade Attended</label>
                                        <input type="text"
                                            class="form-control @error('last_grade_attended') is-invalid @enderror"
                                            id="last_grade_attended" name="last_grade_attended"
                                            placeholder="Enter the last grade attended"
                                            value="{{ old('last_grade_attended') }}">
                                        @error('last_grade_attended')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="adviser_name">Adviser's Name from the last year attended</label>
                                        <input type="text"
                                            class="form-control @error('adviser_name') is-invalid @enderror"
                                            id="adviser_name" name="adviser_name" placeholder="Enter your adviser's name"
                                            value="{{ old('adviser_name') }}">
                                        @error('adviser_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="adviser_section">Section</label>
                                        <input type="text"
                                            class="form-control @error('adviser_section') is-invalid @enderror"
                                            id="adviser_section" name="adviser_section" placeholder="Enter the section"
                                            value="{{ old('adviser_section') }}">
                                        @error('adviser_section')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Account Information -->
                                <h5 class="category-label">Account Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Enter your email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" placeholder="Enter your password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm your password">
                                    </div>
                                </div>

                                <!-- Guardian Information -->
                                <h5 class="category-label">Guardian's Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="guardian_full_name">Guardian's Full Name</label>
                                        <input type="text"
                                            class="form-control @error('guardian_full_name') is-invalid @enderror"
                                            id="guardian_full_name" name="guardian_full_name"
                                            placeholder="Enter your guardian's full name"
                                            value="{{ old('guardian_full_name') }}">
                                        @error('guardian_full_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="guardian_contact_number">Guardian's Contact Number</label>
                                        <input type="text"
                                            class="form-control @error('guardian_contact_number') is-invalid @enderror"
                                            id="guardian_contact_number" name="guardian_contact_number"
                                            placeholder="Enter your guardian's contact number"
                                            value="{{ old('guardian_contact_number') }}">
                                        @error('guardian_contact_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="alert alert-info" role="alert">
                                    Your data is treated with confidentiality and is protected under the Data Privacy Act of
                                    2012 (RA No. 10173).
                                </div>

                                <!-- Sign Up Button -->
                                <button type="submit" class="common-button btn-primary btn-block">Sign Up</button>
                            </form>
                            <center>
                                <p class="signup-text">Already have an account? <a href="/">Login here.</a></p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('email-exist'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Email is already registered.',
                    showConfirmButton: false,
                    timer: 2500,
                })
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
