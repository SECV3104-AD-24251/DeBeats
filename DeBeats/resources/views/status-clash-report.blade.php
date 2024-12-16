@extends ('layoutStudent')

@section('title', 'clash report status')

@section('content')

<link rel="stylesheet" href="{{ asset('css/status-clash.css') }}">
    <div class="container my-5">
        <h1>Status Clash Report</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clashNotifications as $clash)
                    @foreach ($clash['exams'] as $exam)
                        <tr>
                            <td>{{ $clash['date'] }}</td>
                            <td>{{ $clash['start_time'] }}</td>
                            <td>{{ $clash['end_time'] }}</td>
                            <td>{{ $exam->course_code }}</td>
                            <td>
                                <!-- Fetch the course name from the 'courses' table -->
                                {{ $exam->course->course_name ?? 'Course Name Not Available' }}
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="6">No clash reports found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('dashboard.student') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    @endsection