@extends ('layoutStaff')

@section('title', 'Exam List')

@section('content')
<link rel="stylesheet" href="{{asset('css/exam-list.css')}}">

<div class="container">
    <div class="card">
        <div class="card-header">
            Exam Slots
            <a href="/add/exam" class="btn btn-success btn-sm float-end">Add New Exam Slot</a>
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
                    <th>Capacity</th>
                    <th>Venue</th>
                    <th colspan="2">Action</th>
                </thead>
                <tbody>
                    @if (count($examSlots) > 0)
                        @foreach ($examSlots as $item)
                            <tr class="{{ $item->is_clashing ? 'table-danger' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->course_code }}</td>
                                <td>{{ $item->course_name }}</td>
                                <td>{{ $item->exam_date }}</td>
                                <td>{{ $item->start_time }}</td>
                                <td>{{ $item->end_time }}</td>
                                <td>{{ $item->capacity }}</td>
                                <td>{{ $item->venue_short }}</td>
                                <td><a href="/edit/{{ $item->id }}" class="btn btn-primary btn-sm">Edit</a></td>
                                <td><a href="/delete/{{ $item->id }}" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>    
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">No Exam Slots Found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clashNotifications = @json($clashNotifications);

        if (clashNotifications.length > 0) {
            let message = "Clashes Detected:\n\n";
            const displayedClashes = new Set();

            clashNotifications.forEach(notification => {
                // Create a unique identifier for the clash
                const clashKey = [notification.currentCourseCode, notification.clashingCourseCode].sort().join('-');

                // Check if the clash is already displayed
                if (!displayedClashes.has(clashKey)) {
                    message += `Course Code: ${notification.currentCourseCode} (${notification.currentCourseName})\n`;
                    message += `Clashing with: ${notification.clashingCourseCode} (${notification.clashingCourseName})\n`;
                    
                    // Suggest changing the later-added subject
                    message += `Recommendation: Consider changing the schedule for ${notification.clashingCourseCode} (${notification.clashingCourseName}).\n\n`;

                    // Add the clashKey to the displayed set
                    displayedClashes.add(clashKey);
                }
            });

            alert(message);
        }
    });
</script>




@endsection
