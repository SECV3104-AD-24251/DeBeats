@extends('layoutStudent')

@section('title', 'Student Timetable')

@section('content')
<link rel="stylesheet" href="{{ asset('css/student-timetable.css') }}">

<div class="timetable-container">
    <h1>Timetable for {{ $student->name }}</h1>
    <table class="timetable">
        <thead>
            <tr>
                <th>Time</th>
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Define all possible time slots (using 24-hour format)
                $timeSlots = [
                    '08:00:00' => '09:00:00',
                    '09:00:00' => '10:00:00',
                    '10:00:00' => '11:00:00',
                    '11:00:00' => '12:00:00',
                    '12:00:00' => '13:00:00',
                    '13:00:00' => '14:00:00',
                    '14:00:00' => '15:00:00',
                    '15:00:00' => '16:00:00',
                    '16:00:00' => '17:00:00',
                    '17:00:00' => '18:00:00',
                ];
                
                $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];
                
                // Helper function to calculate how many hours between two times
                function getHoursDifference($startTime, $endTime) {
                    $start = strtotime($startTime);
                    $end = strtotime($endTime);
                    return ceil(($end - $start) / 3600);
                }
                
                // Process timetable data to handle multi-hour slots
                $processedTimetable = [];
                foreach ($timetable as $entry) {
                    // Convert time objects to strings for comparison
                    $startTime = date('H:i:00', strtotime($entry->start_time));
                    $endTime = date('H:i:00', strtotime($entry->end_time));
                    
                    $hours = getHoursDifference($startTime, $endTime);
                    
                    $processedTimetable[$entry->day][$startTime] = [
                        'course_name' => $entry->course_name,
                        'course_code' => $entry->course_code,
                        'rowspan' => $hours
                    ];
                }
            @endphp

            @foreach ($timeSlots as $startTime => $endTime)
                <tr>
                    <td class="time-slot">
                        {{ date('H:i', strtotime($startTime)) }} - {{ date('H:i', strtotime($endTime)) }}
                    </td>
                    @foreach ($days as $day)
                        @php
                            $skipCell = false;
                            if (isset($processedTimetable[$day])) {
                                foreach ($processedTimetable[$day] as $classStartTime => $class) {
                                    $classEndTime = date('H:i:00', strtotime($classStartTime . " + {$class['rowspan']} hours"));
                                    if ($startTime > $classStartTime && $startTime < $classEndTime) {
                                        $skipCell = true;
                                        break;
                                    }
                                }
                            }
                        @endphp

                        @if (!$skipCell)
                            @if (isset($processedTimetable[$day][$startTime]))
                                <td class="has-class" rowspan="{{ $processedTimetable[$day][$startTime]['rowspan'] }}">
                                    <div class="course-info">
                                        {{ $processedTimetable[$day][$startTime]['course_name'] }}<br>
                                        <span class="course-code">({{ $processedTimetable[$day][$startTime]['course_code'] }})</span>
                                    </div>
                                </td>
                            @else
                                <td></td>
                            @endif
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection