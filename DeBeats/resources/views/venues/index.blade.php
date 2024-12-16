@extends ('layoutStaff')

@section('title', 'Exam List')

@section('content')
<link rel="stylesheet" href="{{ asset('css/venueInfo.css') }}">
    <h1>Venues Information</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Unit Number</th>
                <th>Venue Name</th>
                <th>Short Name</th>
                <th>Type</th>
                <th>Capacity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venues as $venue)
                <tr>
                    <td>{{ $venue->id }}</td>
                    <td>{{ $venue->unit_number }}</td>
                    <td>{{ $venue->venue_name }}</td>
                    <td>{{ $venue->venue_short }}</td>
                    <td>{{ $venue->type }}</td>
                    <td>{{ $venue->capacity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection