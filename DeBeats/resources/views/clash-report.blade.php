@extends('layoutStudent') <!-- Extends the layout -->

@section('title', 'Student Exam List') <!-- Matches @yield('title') in the layout -->

@section('content')
<link rel="stylesheet" href="{{ asset('css/clash-report.css') }}">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    

        <!-- Report Form -->
        <div class="card">
            <div class="card-header">
                Clash Report Form
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('status.clash.report') }}">
    @csrf

    <!-- Student Name field with pre-filled value -->
    <div class="mb-3">
        <label for="name" class="form-label">Student Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
    </div>

    <!-- UTMID field with pre-filled value -->
    <div class="mb-3">
        <label for="utmid" class="form-label">UTMID</label>
        <input type="text" class="form-control" id="utmid" name="utmid" value="{{ Auth::user()->UTMID }}" readonly>
    </div>

    <!-- Clash Details Display -->
    <div class="mb-3">
        <label for="clash_details" class="form-label">Clash Details</label>
        <div id="clash_details" class="form-control clash-details" style="white-space: pre-wrap;">
            @if (isset($clashNotifications) && count($clashNotifications) > 0)
                @foreach ($clashNotifications as $clash)
                    <p class="clash-header">
                        <span><strong>Date:</strong> {{ $clash['date'] }} </span>
                        <span><strong>Start Time:</strong> {{ $clash['start_time'] }} </span>
                        <span><strong>End Time:</strong> {{ $clash['end_time'] }}</span>
                    </p>
                    @foreach ($clash['exams'] as $index => $exam)
                        <p class="course-info">
                            <strong>{{ $index + 1 }}. {{ $exam->course_code }}:</strong> {{ $exam->course_name }}
                        </p>
                    @endforeach
                @endforeach
            @else
                <p>No clashes detected.</p>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-danger">Submit</button>
    
</form>

            </div>
        </div>
    </div>
@endsection