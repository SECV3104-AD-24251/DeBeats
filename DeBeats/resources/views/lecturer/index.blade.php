@extends('layoutStaff')

@section('title', 'Lecturer List')

@section('content')
<link rel="stylesheet" href="{{ asset('css/lecturer-information.css') }}">

<h1>Lecturer Information</h1>
<div class="lecturer-grid">
    @foreach ($lecturer as $lecturer)
        <div class="lecturer-card">
            <img src="{{ asset($lecturer->image_path) }}" alt="Photo of {{ $lecturer->name }}" class="lecturer-photo">
            <div class="lecturer-details">
                <h2>{{ $lecturer->name }}</h2>
                <p><strong>UTMID:</strong> {{ $lecturer->UTMID }}</p>
                <p><strong>Course Code:</strong> {{ $lecturer->course_code }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection