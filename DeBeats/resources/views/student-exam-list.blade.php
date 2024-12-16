@extends('layoutStudent') <!-- Extends the layout -->

@section('title', 'Student Exam List') <!-- Matches @yield('title') in the layout -->

@section('content')
<link rel="stylesheet" href="{{ asset('css/student-exam-list.css') }}">
    <div class="container">
        <!-- Home button positioned at the top-left -->
        <div class="d-flex justify-content-start my-3">
            <a href="{{ route('dashboard.student') }}" class="btn btn-secondary">Home</a>
        </div>

        <div class="card">
            <div class="card-header">
                Exam Slots
            </div>
            @if (Session::has('success'))
                <span class="alert alert-success p-2">{{ Session::get('success') }}</span>
            @endif
            @if (Session::has('fail'))
                <span class="alert alert-danger p-2">{{ Session::get('fail') }}</span>
            @endif
            <div class="card-body">
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                        <th>No.</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Exam Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Venue</th>
                    </thead>
                    <tbody>
                        @if (count($examSlots) > 0)
                            @foreach ($examSlots as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->course_code }}</td>
                                    <td>{{ $item->course_name }}</td>
                                    <td>{{ $item->exam_date }}</td>
                                    <td>{{ $item->start_time }}</td>
                                    <td>{{ $item->end_time }}</td>
                                    <td>{{ $item->venue_short }}</td>
                                </tr>    
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">No Exam Slots Available!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Custom Modal -->
    <div class="custom-modal" id="clashModal">
        <div class="modal-header">
            <strong>Exam Clash Notifications</strong>
        </div>
        <div class="modal-body" id="clashDetails">
            <!-- Dynamic Clash Details will be inserted here -->
        </div>
        <div class="modal-footer">
            <button class="btn-close" onclick="closeModal()">Close</button>
        </div>
            
    </div>
      <!-- Report Button -->
      <div class="text-center my-4">
            <a href="{{ route('getClashReport') }}" class="btn btn-danger">Report</a>
    </div>

    @endsection
    @section('scripts')

    <script>
    window.onload = function() {
        let clashMessage = 'There are clashes between the following exams:\n\n';
        let clashDetails = '';
        let clashCourses = [];

        @foreach ($clashNotifications as $clash)
            clashDetails += '<p><strong>Date:</strong> {{ $clash['date'] }} | <strong>Start Time:</strong> {{ $clash['start_time'] }} | <strong>End Time:</strong> {{ $clash['end_time'] }}</p>';
            clashDetails += '<ul>';
            @foreach ($clash['exams'] as $exam)
                clashDetails += '<li><strong>{{ $exam->course_code }}:</strong> {{ $exam->course_name }}</li>';
                // Store the course codes with clashes
                clashCourses.push('{{ $exam->course_code }}');
            @endforeach
            clashDetails += '</ul>';
        @endforeach

        // If there are any clashes, show the modal and highlight the clashes in the table
        if (clashDetails !== '') {
            // Display the clash details in the modal
            document.getElementById('clashDetails').innerHTML = clashDetails;
            document.getElementById('clashModal').style.display = 'block';

            // Highlight the clashing courses in the exam list
            let tableRows = document.querySelectorAll('table tbody tr');
            tableRows.forEach(row => {
                let courseCode = row.querySelector('td:nth-child(2)').textContent.trim();
                if (clashCourses.includes(courseCode)) {
                    row.classList.add('highlight-clash');
                }
            });
        }
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('clashModal').style.display = 'none';
    }
</script>



@endsection