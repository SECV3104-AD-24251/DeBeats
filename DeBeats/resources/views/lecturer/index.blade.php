@extends ('layoutStaff')

@section('title', 'Exam List')

@section('content')
<link rel="stylesheet" href="{{ asset('css/venueInfo.css') }}">
    <h1>Lecturer Information</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Lecturer Name</th>
                <th>UTMID</th>
                <th>Course Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lecturer as $lecturer)
                <tr>
                    <td>{{ $lecturer->id }}</td>
                    <td>{{ $lecturer-> name}}</td>
                    <td>{{ $lecturer-> UTMID}}</td>
                    <td>{{ $lecturer->course_code}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection