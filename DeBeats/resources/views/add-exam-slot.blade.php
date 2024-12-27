@extends('layoutLecturer') <!-- Extends the layout -->

@section('title', 'Add Exam Slot') <!-- Matches @yield('title') in the layout -->

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!--this is a must include so that your script can run well-->
<link rel="stylesheet" href="{{ asset('css/add-exam-slot.css') }}">
    <div class="container">
        <div class="card">
            <div class="card-header">Add New Exam Slot</div>
            @if (Session::has('fail'))
                <span class="alert alert-danger p-2">{{Session::get('fail')}}</span>
            @endif
            <div class="card-body">
                <form action="{{ route('AddExamSlot') }}" method="POST">
                    @csrf
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
                        <label for="exam_date" class="form-label">Exam Date</label>
                        <input type="date" name="exam_date" class="form-control" id="exam_date" required min="{{ date('Y-m-d') }}" 
                            value="{{ request()->query('date', date('Y-m-d')) }}">
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" id="start_time" required onchange="getCourseName()">
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" id="end_time" required onchange="getCourseName()">
                        <p id="time_error" style="color: red; display: none;"></p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="text" name="capacity" class="form-control" id="capacity" placeholder="Enter Capacity" readonly required>
                    </div> 
                    <div class="mb-3">
    <label for="venue_short" class="form-label">Venue</label>
    <select name="venue_short" class="form-control" id="venue_short" required>
        <option value="">Select a Venue</option>
    </select>
</div>


                    <button type="submit" id="submit_button" class="btn btn-primary">Save</button>
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
     
     function getCourseName() {
    let courseCode = $('#course_code').val();
    let examDate = $('#exam_date').val();
    let startTime = $('#start_time').val();
    let endTime = $('#end_time').val();

    if (courseCode.length > 0) {
        $.ajax({
            url: '/get-course-name',
            method: 'GET',
            data: {
                course_code: courseCode,
                exam_date: examDate,
                start_time: startTime,
                end_time: endTime,
            },
            success: function(response) {
                if (response.success) {
                    $('#course_name').val(response.course_name);
                    $('#capacity').val(response.capacity);

                    // Clear the previous venue options
                    $('#venue_short').empty();

                    // Add new venue options based on available venues
                    if (response.venues.length > 0) {
                        response.venues.forEach(function(venue) {
                            $('#venue_short').append('<option value="' + venue.venue_short + '">' + venue.venue_name + ' (Capacity: ' + venue.capacity + ')</option>');
                        });
                    } else {
                        $('#course_name_error').text(''); 
                        $('#venue_short').append('<option>No venue available</option>');
                        
                    }

                    
                } else {
                    $('#course_name').val('');
                    $('#capacity').val('');
                    $('#venue_short').empty();
                    $('#course_name_error').text(response.message);
                }
            }
        });
    } else {
        $('#course_name').val('');
        $('#capacity').val('');
        $('#venue_short').empty();
        $('#course_name_error').text('');
    }
}


// Trigger venue filtering when date, start time, or end time changes
$('#exam_date, #start_time, #end_time').on('change', getCourseName);



        // Select inputs and button
    const timeStartInput = document.getElementById('start_time');
    const timeEndInput = document.getElementById('end_time');
    const timeErrorDisplay = document.getElementById('time_error');
    const submitButton = document.getElementById('submit_button');

    function validateTime() {
        const startTime = timeStartInput.value;
        const endTime = timeEndInput.value;

        // Check if end time is greater than start time
        if (startTime && endTime && startTime >= endTime) {
            timeErrorDisplay.textContent = 'End time must be greater than start time!';
            timeErrorDisplay.style.display = 'block';
            submitButton.disabled = true; // Disable Save button
        } else {
            timeErrorDisplay.style.display = 'none';
            submitButton.disabled = false; // Enable Save button
        }
    }

    // Add event listeners for dynamic validation
    timeStartInput.addEventListener('input', validateTime);
    timeEndInput.addEventListener('input', validateTime);

    // Final validation on form submission
    document.querySelector('form').addEventListener('submit', (event) => {
        validateTime();
        if (timeStartInput.value >= timeEndInput.value) {
            event.preventDefault(); // Prevent form submission
            alert('Please correct the time fields before submitting.');
        }
    });

    
        // Function to validate course code and fetch related data
function validateCourseCode() {
    let courseCode = $('#course_code').val();

    if (courseCode.length > 0) {
        $.ajax({
            url: '/validate-course-code', // Endpoint for validation
            method: 'GET',
            data: { course_code: courseCode },
            success: function(response) {
                if (response.success) {
                    $('#course_name').val(response.course_name); // Populate course name
                    $('#course_name_error').text(''); // Clear error message
                } else {
                    $('#course_name').val(''); // Clear course name field
                    $('#course_name_error').text(response.message); // Show error message
                }
            },
          
        });
    } else {
        $('#course_name').val('');
        $('#course_name_error').text('Course code cannot be empty.');
    }
}
// Trigger validation when the user finishes entering the course code
$('#course_code').on('blur', validateCourseCode);


        // Add event listeners for dynamic validation
        timeStartInput.addEventListener('input', validateTime);
        timeEndInput.addEventListener('input', validateTime);

        // Final validation on form submission
        document.querySelector('form').addEventListener('submit', (event) => {
            validateTime();
            if (timeStartInput.value >= timeEndInput.value) {
                event.preventDefault(); // Prevent form submission
                alert('Please correct the time fields before submitting.');
            }
        });
    </script>
@endsection
