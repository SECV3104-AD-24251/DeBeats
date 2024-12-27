@extends('layoutStudent') <!-- Extends the layout -->

@section('title', 'Student Test List') <!-- Matches @yield('title') in the layout -->

@section('content')
<link rel="stylesheet" href="{{ asset('css/student-exam-list.css') }}">
<div class="container">
    <div class="card">
        <div class="card-header">
        Test Slots
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
                    <!-- <th>Capacity</th> -->
                    <th>Exam Date</th>
                    <th>Duration</th>
                    <!-- <th>Type</th> -->
                    <th>Venue</th>
                </thead>
                <tbody>
                    @if (count($testSlots) > 0)
                        @foreach ($testSlots as $item)
                            <tr class="{{ $item->is_clashing ? 'table-danger' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->course_code }}</td>
                                <td>{{ $item->course_name }}</td>
                                <!-- <td>{{ $item->capacity }}</td> -->
                                <td>{{ $item->exam_date }}</td>
                                <td>{{ $item->duration }}</td>
                                <!-- <td>{{ $item->type }}</td> -->
                                <td>{{ $item->venue_short }}</td>
                            </tr>    
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">No Test Slots Found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

    @endsection
   



