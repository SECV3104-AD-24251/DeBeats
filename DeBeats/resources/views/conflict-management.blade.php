@extends ('layoutStaff')

@section('title', 'Exam List')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container my-5">
        <h1>All Clash Reports</h1>

        @if (isset($clashReports) && count($clashReports) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>UTMID</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th> 
                            <th>Course Code</th>
                            <th>Course Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clashReports as $report)
                            <tr>
                                <td>{{ $report->student->name ?? 'Unknown' }}</td> <!-- Assuming you have a relationship with the User model -->
                                <td>{{ $report->UTMID }}</td>
                                <td>{{ $report->date }}</td>
                                <td>{{ $report->start_time }}</td>
                                <td>{{ $report->end_time }}</td>
                                <td>{{ $report->course_code }}</td>
                                <td>
                                    <!-- Fetch course name using the course_code -->
                                    {{ $report->course->course_name ?? 'Course Name Not Available' }}
                                </td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No clash reports submitted yet.</p>
        @endif
    </div>
@endsection
 