@extends('layoutStaff') <!-- Extends the layout -->

@section('title', 'Add Exam Slot') <!-- Matches @yield('title') in the layout -->

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- This is a must include so that your script can run well -->
<link rel="stylesheet" href="{{ asset('css/add-exam-slot.css') }}">

<style>#exam_date, #end_time, #capacity, #venue_short {
    display: none !important;
}
</style>

<div class="container">
    <div class="card">
        <div class="card-header">Add New Exam Slot</div>
        @if (Session::has('fail'))
            <span class="alert alert-danger p-2">{{ Session::get('fail') }}</span>
        @endif
        <div class="card-body">
            <form action="{{ route('AddExamSlot') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="type" class="form-label">Exam Type</label>
                    <select name="type" class="form-control" id="type" required>
                        <option value="">Select Exam Type</option>
                        <option value="bilik kuliah">Writing</option>
                        <option value="makmal">Lab</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="course_code" class="form-label">Course Code</label>
                    <input type="text" name="course_code" class="form-control" id="course_code" placeholder="Enter Course Code" required onkeyup="getCourseName()">
                </div>
                <div class="mb-3">
                    <label for="course_name" class="form-label">Course Name</label>
                    <input type="text" name="course_name" class="form-control" id="course_name" placeholder="Enter Course Name" readonly required>
                    <span id="course_name_error" class="text-danger"></span>
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <select name="duration" class="form-control" id="duration" required onchange="updateEndTime()">
                        <option value="">Select Duration</option>
                        <option value="1:00">1 Hour</option>
                        <option value="1:30">1 Hour 30 Minutes</option>
                        <option value="2:00">2 Hours</option>
                        <option value="2:30">2 Hours 30 Minutes</option>
                        <option value="3:00">3 Hours</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Time Slot</label>
                    <select name="start_time" class="form-control" id="start_time" required onchange="updateEndTime()">
                        <option value="">Select Time Slot</option>
                        <option value="09:00">Morning</option>
                        <option value="14:30">Evening</option>
                    </select>
                </div>

                <div class="mb-3 d-none">
                    <label for="end_time" class="form-label"></label>
                    <input type="text" name="end_time" class="form-control" id="end_time" readonly>
                </div>

                <div class="mb-3 d-none">
                    <label for="exam_date" class="form-label"></label>
                    <input type="text" id="exam_date" class="form-control" name="exam_date" readonly>

                </div>

                <div class="mb-3 d-none">
                    <label for="capacity" class="form-label"></label>
                    <input type="text" name="capacity" class="form-control" id="capacity" placeholder="Enter Capacity" readonly required>
                </div> 
                <div class="mb-3 d-none">
    <label for="venue_short" class="form-label"></label>
    <select name="venue_short" class="form-control" id="venue_short"placeholder="Enter Venue" required>
     
    </select>
</div>

                <button type="submit" id="submit_button" class="btn btn-primary">Add</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
 document.addEventListener("DOMContentLoaded", function() {
    // Leave the date field blank initially
    document.getElementById('exam_date').value = '';
});

document.getElementById('start_time').addEventListener('change', function () {
    const startTime = this.value;

    if (startTime) {
        fetch(`/check-available-date?start_time=${startTime}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('exam_date').value = data.suggested_date;
                } else {
                    alert(data.message);
                    document.getElementById('exam_date').value = ''; // Clear date field
                }
            })
            .catch(error => console.error('Error:', error));
    }
});


    function updateEndTime() {
        const duration = $('#duration').val();
        const startTime = $('#start_time').val();
        const endTimeInput = $('#end_time');

        if (duration && startTime) {
            const [startHours, startMinutes] = startTime.split(':').map(Number);
            const startDateTime = new Date();
            startDateTime.setHours(startHours, startMinutes, 0, 0);

            const [durationHours, durationMinutes] = duration.split(':').map(Number);
            const endDateTime = new Date(startDateTime);
            endDateTime.setHours(startDateTime.getHours() + durationHours);
            endDateTime.setMinutes(startDateTime.getMinutes() + durationMinutes);

            const endHours = endDateTime.getHours().toString().padStart(2, '0');
            const endMinutes = endDateTime.getMinutes().toString().padStart(2, '0');
            endTimeInput.val(`${endHours}:${endMinutes}`);
        } else {
            endTimeInput.val('');
        }
    }

    function checkForDuplicates() {
        const courseCode = $('#course_code').val();
        const examDate = $('#exam_date').val();
        const startTime = $('#start_time').val();
        const endTime = $('#end_time').val();

        if (courseCode && examDate && startTime && endTime) {
            $.ajax({
                url: '/check-duplicate-slot',
                method: 'GET',
                data: { course_code: courseCode, exam_date: examDate, start_time: startTime, end_time: endTime },
                success: function(response) {
                    if (response.is_duplicate) {
                        $('#course_name_error').text('This exam slot already exists.');
                        $('#submit_button').prop('disabled', true);
                    } else {
                        $('#course_name_error').text('');
                        $('#submit_button').prop('disabled', false);
                    }
                }
            });
        } else {
            $('#course_name_error').text('');
            $('#submit_button').prop('disabled', false);
        }
    }

    $(document).ready(function() {
        $('#course_code, #exam_date, #start_time, #end_time').on('input change', checkForDuplicates);
        $('#duration, #start_time').on('change', updateEndTime);

        function getCourseName() {
    let courseCode = $('#course_code').val();
    let examDate = $('#exam_date').val();
    let startTime = $('#start_time').val();
    let endTime = $('#end_time').val();
    let venueType = $('#type').val();  // Get selected venue type


    if (courseCode.length > 0) {
        $.ajax({
            url: '/get-course-name',
            method: 'GET',
            data: {
                course_code: courseCode,
                exam_date: examDate,
                start_time: startTime,
                end_time: endTime,
                venue_type: venueType  // Send venue type to fetch corresponding venues
            },
            success: function(response) {
                if (response.success) {
                    $('#course_name').val(response.course_name);
                    $('#capacity').val(response.capacity);
                    $('#venue_short').empty();  // Clear existing venues


                    // Automatically suggest the randomly selected venue
                    if (response.venue_short) {
                        $('#venue_short').append('<option value="' + response.venue_short + '" selected>' + response.venue_name + ' (Capacity: ' + response.venue_capacity + ')</option>');
                    } else {
                        $('#venue_short').append('<option value="">No available venues</option>');
                    }
                } else {
                    $('#course_name').val('');
                    $('#capacity').val('');
                    $('#venue_short').empty();
                    $('#course_name_error').text(response.message);
                }
            },
            error: function() {
                alert("Error fetching course details.");
            }
        });
    } else {
        $('#course_name').val('');
        $('#capacity').val('');
        $('#venue_short').empty();
        $('#course_name_error').text('');
    }
}


        $('#course_code').on('keyup', getCourseName);
    });
    
   


</script>

@endsection
