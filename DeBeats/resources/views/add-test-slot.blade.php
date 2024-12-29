@extends('layoutLecturer')

@section('title', 'Add Test Slot')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/add-exam-slot.css') }}">

<div class="container">
    <div class="card">
        <div class="card-header">Add New Test Slot</div>
        @if (Session::has('fail'))
            <span class="alert alert-danger p-2">{{ Session::get('fail') }}</span>
        @endif
        <div class="card-body">
            <form action="{{ route('AddTestSlot') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="course_code" class="form-label">Course Code</label>
                    <input type="text" name="course_code" class="form-control" id="course_code" placeholder="Enter Course Code" required>
                </div>
                <div class="mb-3">
                    <label for="course_name" class="form-label">Course Name</label>
                    <input type="text" name="course_name" class="form-control" id="course_name" placeholder="Enter Course Name" required readonly>
                    <span id="course_name_error" class="text-danger"></span>
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label">Course Capacity</label>
                    <input type="text" name="capacity" class="form-control" id="capacity" placeholder="Enter Course Capacity" required readonly>
                </div>
                <div class="mb-3">
                    <label for="exam_date" class="form-label">Exam Date</label>
                    <input type="date" name="exam_date" class="form-control" id="exam_date" required>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <select name="duration" class="form-control" id="duration" required>
                        <option value="20:00-22:00">8:00 PM - 10:00 PM</option>
                        <option value="20:00-22:30">8:00 PM - 10:30 PM</option>
                        <option value="20:00-23:00">8:00 PM - 11:00 PM</option>
                    </select>
                </div>
                <div class="mb-3">
    <label for="exam_type" class="form-label">Test Type</label>
    <select name="exam_type" class="form-control" id="exam_type" required>
        <option value="">Select Test Type</option>
        <option value="Test 1">Test 1</option>
        <option value="Test 2">Test 2</option>
        <option value="Lab Test">Lab Test</option>
    </select>
</div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" class="form-control" id="type" required>
                        <option value="">Select Type</option>
                        <option value="bilik kuliah">Bilik Kuliah</option>
                        <option value="makmal">Makmal</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="venues" class="form-label">Select Venues</label>
                    <div id="venue-checkbox-list">
                        <!-- Venue checkboxes will be dynamically inserted here -->
                    </div>
                    <div> Total Venue Capacity Selected: 
                        <span id="total-venue-capacity">0</span>
                    </div>
                </div>
                <div class="mb-3">
    <label for="file" class="form-label">Test Paper</label>
    <input type="file" name="file" class="form-control" id="fileInput" />
    <span id="filePreview"></span>
    @if ($errors->has('file'))
        <span class="text-danger">{{ $errors->first('file') }}</span>
    @endif
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
    // Update Venue Checkbox Rendering
$('#type').on('change', function() {
    var selectedType = $(this).val();
    if (selectedType) {
        $.ajax({
            url: '/venues/' + selectedType,
            method: 'GET',
            success: function(response) {
                var venueList = $('#venue-checkbox-list');
                venueList.empty();
                response.forEach(function(venue) {
                    venueList.append(
                        '<div class="form-check">' +
                            '<input class="form-check-input venue-checkbox" type="checkbox" name="venues[]" value="' + venue.venue_short + '" id="venue_' + venue.venue_short + '" data-capacity="' + venue.capacity + '">' +
                            '<label class="form-check-label" for="venue_' + venue.venue_short + '">' +
                                venue.venue_name + ' (Capacity: ' + venue.capacity + ')' +
                            '</label>' +
                        '</div>'
                    );
                });
                updateVenueCapacity(); // Initialize total capacity
            },
            error: function() {
                alert('Failed to fetch venues.');
            }
        });
    } else {
        $('#venue-checkbox-list').empty();
        updateVenueCapacity(); // Reset total capacity
    }
});

// Calculate and Display Total Venue Capacity
function updateVenueCapacity() {
    var totalVenueCapacity = 0;

    // Sum up the capacities of checked venues
    $('input[name="venues[]"]:checked').each(function() {
        totalVenueCapacity += parseInt($(this).data('capacity'));
    });

    // Update the displayed total capacity
    $('#total-venue-capacity').text(totalVenueCapacity);
}

// Listen for Checkbox Changes
$(document).on('change', '.venue-checkbox', function() {
    updateVenueCapacity();
});

// Validate Venue Capacity Before Submitting Form
$('#submit_button').on('click', function(e) {
    e.preventDefault(); // Prevent form submission

    var courseCapacity = parseInt($('#capacity').val());
    var totalVenueCapacity = 0;

    // Calculate total capacity of selected venues
    $('input[name="venues[]"]:checked').each(function() {
        totalVenueCapacity += parseInt($(this).data('capacity'));
    });

    if (totalVenueCapacity < courseCapacity) {
        alert('The total capacity of selected venues is less than the course capacity.');
        return false; // Prevent form submission
    }

    // Submit the form if validation passes
    $('form').submit();
});


    $('#course_code').on('input', function() {
        var courseCode = $(this).val();
        if (courseCode.length > 0) {
            $.ajax({
                url: '/course/details/' + courseCode,
                method: 'GET',
                success: function(response) {
                    if (response.course_name && response.capacity) {
                        $('#course_name').val(response.course_name);
                        $('#capacity').val(response.capacity);
                    } else {
                        $('#course_name').val('');
                        $('#capacity').val('');
                        $('#course_name_error').text('No course found with this code');
                    }
                },
                error: function() {
                    $('#course_name').val('');
                    $('#capacity').val('');
                    $('#course_name_error').text('Failed to fetch course details');
                }
            });
        } else {
            $('#course_name').val('');
            $('#capacity').val('');
            $('#course_name_error').text('');
        }
    });

    $('#exam_date').on('change', function() {
        var selectedDate = new Date($(this).val());
        var dayOfWeek = selectedDate.getDay();
        if (dayOfWeek == 5 || dayOfWeek == 6) {
            alert("You cannot select a Friday or Saturday as the exam date.");
            $(this).val('');
        }
    });

    $(document).ready(function() {
    // Fetch booked dates
    $.ajax({
        url: '/booked-dates',
        method: 'GET',
        success: function(bookedDates) {
            // Disable booked dates
            $('#exam_date').attr('min', '{{ date('Y-m-d') }}'); // Ensure the min date is today
            $('#exam_date').on('focus', function() {
                $(this).attr('min', '{{ date('Y-m-d') }}');
            });

            $('#exam_date').on('input', function() {
                var selectedDate = new Date($(this).val());
                var dayOfWeek = selectedDate.getDay();
                if (dayOfWeek == 5 || dayOfWeek == 6) {
                    alert("You cannot select a Friday or Saturday as the exam date.");
                    $(this).val('');
                } else if (bookedDates.includes($(this).val())) {
                    alert("This date is already booked for another exam. Please choose a different date.");
                    $(this).val('');
                }
            });
        },
        error: function() {
            alert('Failed to fetch booked dates.');
        }
    });
});

document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const filePreview = document.getElementById('filePreview');

    if (file) {
        // Clear any previous preview
        filePreview.innerHTML = '';

        // Create a link to preview the file
        const fileLink = document.createElement('a');
        fileLink.href = URL.createObjectURL(file);
        fileLink.target = '_blank';
        fileLink.textContent = 'View Selected File';
        fileLink.classList.add('btn', 'btn-link');

        // Append the link to the preview section
        filePreview.appendChild(fileLink);
    } else {
        // Clear preview if no file is selected
        filePreview.innerHTML = 'No file selected.';
    }
});

</script>
@endsection
