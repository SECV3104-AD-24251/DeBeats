@extends('layoutLecturer')

@section('title', 'Add Test Slot')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/add-test-slot.css') }}">

<div class="container">
    <div class="card">
        <div class="card-header">Add New Test Slot</div>
        @if (Session::has('fail'))
            <span class="alert alert-danger p-2">{{ Session::get('fail') }}</span>
        @endif
        <div class="card-body">
        <form action="{{ route('AddTestSlot') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Course Code (Auto-filled) -->
                <div class="mb-3">
                    <label for="course_code" class="form-label">Course Code</label>
                    <input type="text" id="course_code" name="course_code" class="form-control" value="{{ $course_code }}" readonly>
                </div>

                <!-- Course Name (Auto-filled) -->
                <div class="mb-3">
                    <label for="course_name" class="form-label">Course Name</label>
                    <input type="text" id="course_name" name="course_name" class="form-control" value="{{ $course_name }}" readonly>
                </div>

                <!-- Capacity (Auto-filled) -->
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="text" id="capacity" name="capacity" class="form-control" value="{{ $capacity }}" readonly>
                </div>
                <div class="mb-3">
                <input type="date" name="exam_date" class="form-control" id="exam_date" 
                value="{{ request()->query('date') ? request()->query('date') : '' }}" 
                min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <select name="duration" class="form-control" id="duration" required>
                    <option value="">Select Duration</option>
                        <option value="1:00">1 Hour</option>
                        <option value="1:30">1 Hour 30 Minutes</option>
                        <option value="2:00">2 Hours</option>
                        <option value="2:30">2 Hours 30 Minutes</option>
                        <option value="3:00">3 Hours</option>
                    </select>
                </div>
                <div class="mb-3">
    <label for="suggested_times" class="form-label">Suggested Time Slots</label>
    <div id="suggested-times">
        <!-- Suggested time slots will be dynamically inserted here -->
    </div>
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
                    <label for="type" class="form-label">Venue Type</label>
                    <select name="type" class="form-control" id="type" required>
                        <option value="">Select Type</option>
                        <option value="bilik kuliah">Bilik Kuliah</option>
                        <option value="makmal">Makmal</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="venues" class="form-label">Venue Suggested</label>
                    <div id="venue-list">
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
    $('#type').on('change', function () {
    var selectedType = $(this).val();
    var requiredCapacity = $('#capacity').val();




    if (selectedType) {
        $.ajax({
            url: '/suggest-venues',
            method: 'GET',
            data: {
                type: selectedType,
                capacity: requiredCapacity,
            },
            success: function (response) {
                var venueList = $('#venue-list');
                venueList.empty();




                if (response.venues.length > 0) {
                    response.venues.forEach(function (venue) {
                        venueList.append(
                            '<div>' +
                                '<input type="hidden" name="venues[]" value="' + venue.venue_short + '">' +
                                '<span>' + venue.venue_name + ' (Capacity: ' + venue.capacity + ')</span>' +
                            '</div>'
                        );
                    });
                } else {
                    venueList.append('<p>No suitable venue found.</p>');
                }
            },
            error: function () {
                alert('Failed to fetch venue suggestions.');
            }
        });
    } else {
        $('#venue-list').empty();
    }
});



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

    // Submit the form if validation passes
    $('form').submit();
});


$('#course_code').on('change', function () {
    var selectedOption = $(this).find(':selected');
    $('#course_name').val(selectedOption.data('name'));
    $('#capacity').val(selectedOption.data('capacity'));
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


// Global variable to track current request
let currentRequest = null;

// Function to fetch and display available time slots
function fetchAndDisplayTimeSlots() {
    const duration = $('#duration').val();
    const examDate = $('#exam_date').val();
    const courseCode = $('#course_code').val();
    const suggestedTimesContainer = $('#suggested-times');

    // Clear existing content
    suggestedTimesContainer.empty();

    // Validate inputs
    if (!duration || !examDate || !courseCode) {
        suggestedTimesContainer.html(
            !duration ? '<p class="text-muted">Please select a duration to see suggestions</p>' :
            !examDate ? '<p class="text-muted">Please select a date to see suggestions</p>' :
            '<p class="text-muted">Please fill in all required fields</p>'
        );
        return;
    }

    // Show loading message
    suggestedTimesContainer.html('<p>Loading available time slots...</p>');

    // Abort previous request if it exists
    if (currentRequest) {
        currentRequest.abort();
    }

    // Make new request
    currentRequest = $.ajax({
        url: '/fetch-available-slots',
        method: 'POST',
        data: {
            course_code: courseCode,
            exam_date: examDate,
            duration: duration,
            _token: $('meta[name="csrf-token"]').attr('content')
        }
    });

    currentRequest.done(function(response) {
        suggestedTimesContainer.empty();

        if (Array.isArray(response) && response.length > 0) {
            // Build HTML for all slots
            const slotsHTML = response.map(slot => {
                const range = calculateTimeRange(slot, duration);
                const radioId = `time_${slot.replace(':', '_')}`;
                return `
                    <div class="form-check mb-2">
                        <input type="radio" 
                               class="form-check-input" 
                               name="selected_time" 
                               value="${slot}" 
                               id="${radioId}" 
                               required>
                        <label class="form-check-label" for="${radioId}">
                            ${range}
                        </label>
                    </div>
                `;
            }).join('');

            // Insert all at once
            suggestedTimesContainer.html(slotsHTML);
        } else {
            // Fallback to a default suggestion
            const defaultRange = calculateTimeRange('20:00', duration);
            suggestedTimesContainer.html(`<p class="text-muted">No available slots found. ${defaultRange} is suggested.</p>`);
        }
    });

    currentRequest.fail(function(xhr, status, error) {
        console.error('Ajax error:', {
            status,
            error,
            response: xhr.responseText
        });

        suggestedTimesContainer.html(`
            <div class="alert alert-danger">
                Failed to fetch available slots. Please try again.
            </div>
        `);
    });

    currentRequest.always(function() {
        currentRequest = null;
    });
}

// Function to calculate and format time range
function calculateTimeRange(startTimeStr, durationStr) {
    // Parse start time
    const [startHour, startMinute] = startTimeStr.split(':').map(num => parseInt(num, 10));
    const startTime = new Date();
    startTime.setHours(startHour, startMinute, 0);

    // Parse duration
    const [durationHours, durationMinutes] = durationStr.split(':').map(num => parseInt(num, 10));
    
    // Calculate end time
    const endTime = new Date(startTime);
    endTime.setMinutes(startTime.getMinutes() + (durationHours * 60) + durationMinutes);

    // Format both times
    const formattedStart = startTime.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    }).replace(/\s/g, '');

    const formattedEnd = endTime.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    }).replace(/\s/g, '');

    return `${formattedStart} - ${formattedEnd}`;
}

// Attach event listener to fields
$(document).on('change', '#exam_date, #duration', fetchAndDisplayTimeSlots);

// Initialize on page load if both fields are filled
$(document).ready(fetchAndDisplayTimeSlots);


// Remove any existing event listeners first
$('#exam_date, #duration').off('change');

// Add event listeners
$('#exam_date, #duration').on('change', function() {
    fetchAvailableTimeSlots();
});

// Initialize on page load if both date and duration are already selected
$(document).ready(function() {
    if ($('#exam_date').val() && $('#duration').val()) {
        fetchAvailableTimeSlots();
    }
});

$('#duration').on('change', function () {
    const duration = $(this).val();
    const examDate = $('#exam_date').val();
    const courseCode = $('#course_code').val();
    const suggestedTimesContainer = $('#suggested-times');
    
    suggestedTimesContainer.empty();

    if (!duration || !examDate || !courseCode) {
        suggestedTimesContainer.html('<p class="text-danger">Please fill in all required fields</p>');
        return;
    }

    suggestedTimesContainer.html('<p>Loading available time slots...</p>');

    $.ajax({
        url: '/fetch-available-slots',
        method: 'POST',
        data: {
            course_code: courseCode,
            exam_date: examDate,
            duration: duration,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            suggestedTimesContainer.empty();
            
            if (Array.isArray(response) && response.length > 0) {
                response.forEach(slot => {
                    // Create a Date object for formatting (use current date as base)
                    const timeStr = slot.split(':');
                    const date = new Date();
                    date.setHours(parseInt(timeStr[0], 10));
                    date.setMinutes(parseInt(timeStr[1], 10));
                    
                    const formattedTime = date.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    });
                    
                    suggestedTimesContainer.append(`
                        <div class="form-check mb-2">
                            <input type="radio" class="form-check-input" name="selected_time" value="${slot}" id="time_${slot.replace(':', '_')}" required>
                            <label class="form-check-label" for="time_${slot.replace(':', '_')}">
                                ${formattedTime}
                            </label>
                        </div>
                    `);
                });
            } else {
                suggestedTimesContainer.html('<p class="text-muted">No available slots found. 9:00 PM is suggested.</p>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error details:', {
                status: status,
                error: error,
                response: xhr.responseText
            });
            
            let errorMessage = 'Failed to fetch available slots. Please try again.';
            if (xhr.responseJSON && xhr.responseJSON.error) {
                errorMessage = xhr.responseJSON.error;
            }
            
            suggestedTimesContainer.html(`
                <div class="alert alert-danger">
                    ${errorMessage}
                </div>
            `);
        }
    });


});

</script>
@endsection
