@extends('layoutStaff')

@section('title', 'Exam Schedule Timetable')

@section('content')
<link rel="stylesheet" href="{{ asset('css/exam-schedule.css') }}">

<div class="container">
    <h2 class="text-center">Exam Schedule Timetable</h2>

    @php
        // Get the first and last date of exams
        $examDates = collect($groupedSlots->keys());
        $firstDate = $examDates->min();
        $lastDate = $examDates->max();

        // Generate all dates in the range from the first to the last exam date
        $allDates = collect();
        $currentDate = \Carbon\Carbon::parse($firstDate);

        while ($currentDate <= \Carbon\Carbon::parse($lastDate)) {
            $allDates->push($currentDate->format('Y-m-d')); // Add the date to the list
            $currentDate->addDay(); // Move to the next day
        }
    @endphp

    <div class="text-right">
        <!-- Button to trigger the PDF download -->
        <a href="{{ route('exam.schedule.download') }}" class="btn btn-primary">Download as PDF</a>
    </div>

    @if ($allDates->isEmpty())
        <p class="text-center">No exams scheduled.</p>
    @else
        <!-- Timetable Header -->
        <table class="table table-bordered timetable">
            <thead>
                <!-- Day Row -->
                <tr>
                    <th rowspan="2" class="time-slot">No</th>
                    <th rowspan="2" class="course-name-column">Course Name (Course Code)</th>
                    @foreach ($allDates as $date)
                        <th class="day-header">
                            {{ \Carbon\Carbon::parse($date)->format('D') }}
                        </th>
                    @endforeach
                </tr>
                <!-- Date Row -->
                <tr>
                    @foreach ($allDates as $date)
                        <th class="date-header">
                            {{ \Carbon\Carbon::parse($date)->format('d M') }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1; // Counter for row numbering
                @endphp

                @foreach ($groupedSlots as $date => $slots)
                    @foreach ($slots as $slot)
                        <tr>
                            <!-- No column -->
                            <td>{{ $count++ }}</td>

                            <!-- Course Name and Code -->
                            <td class="course-name-column">
                                <div class="course-name">
                                    {{ $slot->course_name }}
                                </div>
                                <div class="course-code">
                                    ({{ $slot->course_code }})
                                </div>
                            </td>

                            <!-- Date Columns -->
                            @foreach ($allDates as $slotDate)
                                <td class="{{ $slotDate === $date ? 'highlight' : '' }}">
                                    @if ($slotDate === $date)
                                        <div class="exam-detail">
                                            Venue: {{ $slot->venue_short }}<br>
                                            Start: {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}<br>
                                            End: {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach

            </tbody>
        </table>
    @endif
</div>

@endsection
