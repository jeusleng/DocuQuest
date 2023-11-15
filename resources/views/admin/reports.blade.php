<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
   
    <!-- Add your styles or use Bootstrap for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Add Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h4 class="mb-4">Documents Requested by Students</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Document Type</th>
                    <th>Number of Copies</th>
                    <th>Student Name</th>
                    <th>Purpose</th>
                    <th>Date Requested</th>
                    <th>Date Completed</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documentsRequested as $document)
                    <tr>
                        <td>{{ $document->document_type }}</td>
                        <td>{{ $document->number_of_copies }}</td>
                        <td>{{ $document->first_name }} {{ $document->last_name }}</td>
                        <td>{{ $document->purpose }}</td>
                        <td>{{ $document->created_at }}</td>
                        <td>{{ $document->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>

        <h4 class="mb-4">Documents and Request Counts</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Document Type</th>
            <th>Request Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documentRequestCounts as $document)
            <tr>
                <td>{{ $document->document_type }}</td>
                <td>{{ $document->request_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>

        <h4 class="mb-4">Months When Students Requested Documents</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Number of Requests</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthsRequested as $month)
                    <tr>
                        <td>{{ $month->month }}</td>
                        <td>{{ $month->request_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>

        <h4 class="mb-4">Name of Students with Requested Documents</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>User Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach($studentsWithDocuments as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                <td>
                    @if($student->student_type == 'alumni')
                        Alumni
                    @elseif($student->student_type == 'current')
                        Current Student
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>
