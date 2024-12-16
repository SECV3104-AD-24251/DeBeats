<!-- resources/views/edit-exam.blade.php -->
@extends('layoutStaff') <!-- Extends the layout -->

@section('title', 'Add Exam Slot') <!-- Matches @yield('title') in the layout -->

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <div class="container">
        <div class="card">
            <div class="card-header">Edit Exam Slot</div>
            @if (Session::has('fail'))
                <span class="alert alert-danger p-2">{{Session::get('fail')}}</span>
            @endif
            <div class="card-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <form action="{{ route('EditExamSlot')}}" method="POST">
                    @csrf
                    <input type="hidden" name="exam_slot_id" value="{{$exam_slot->id}}">
                    <div class="mb-3">
                        <label for="course_code" class="form-label">Course Code</label>
                        <input type="text" name="course_code" class="form-control" value="{{$exam_slot->course_code}}" id="course_code" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" name="course_name" class="form-control" value="{{$exam_slot->course_name}}" id="course_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exam_date" class="form-label">Exam Date</label>
                        <input type="date" name="exam_date" class="form-control" value="{{ $exam_slot->exam_date }}" id="exam_date" min="{{ now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" value="{{ $exam_slot->start_time }}" id="start_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" value="{{ $exam_slot->end_time }}" id="end_time" required>
                        <p id="time_error" style="color: red; display: none;"></p>
                    </div>
                    
    
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="text" name="capacity" class="form-control" value="{{ $exam_slot->capacity }}" id="capacity" readonly required>
                    </div>
                    <div class="mb-3">
                    <label for="venue_short" class="form-label">Venue</label>
                    <select name="venue_short" class="form-control" id="venue_short" required>
                            <option value="">Select a Venue</option>
                            @foreach ($venues as $venue)
                                <option value="{{ $venue->venue_short }}" 
                                        {{ $venue->venue_short == $exam_slot->venue_short ? 'selected' : '' }}>
                                    {{ $venue->venue_name }} (Capacity: {{ $venue->capacity }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" id="submit_button" class="btn btn-primary">Save Changes</button>

                    </form>
                
            </div>
        </div>
    </div>

@endsection
@section('scripts')

  <script>
// Validate time inputs
const timeStartInput = document.getElementById('start_time');
const timeEndInput = document.getElementById('end_time');
const timeErrorDisplay = document.getElementById('time_error');
const submitButton = document.getElementById('submit_button');

function validateTime() {
    const startTime = timeStartInput.value;
    const endTime = timeEndInput.value;

    if (startTime && endTime && startTime >= endTime) {
        timeErrorDisplay.textContent = 'End time must be greater than start time!';
        timeErrorDisplay.style.display = 'block';
        submitButton.disabled = true;
    } else {
        timeErrorDisplay.style.display = 'none';
        submitButton.disabled = false;
    }
}

timeStartInput.addEventListener('input', validateTime);
timeEndInput.addEventListener('input', validateTime);

document.querySelector('form').addEventListener('submit', (event) => {
    validateTime();
    if (timeStartInput.value >= timeEndInput.value) {
        event.preventDefault();
        alert('Please correct the time fields before submitting.');
    }
});
</script>
@endsection
           