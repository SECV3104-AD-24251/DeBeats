@extends ('layoutStaff')

@section('title', 'Test Venues List')

@section('content')
<link rel="stylesheet" href="{{ asset('css/venueInfo.css') }}">
    <h1>Test Venues Information</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Unit Number</th>
                <th>Venue Name</th>
                <th>Short Name</th>
                <th>Type</th>
                <th>Capacity</th>
                <th>Available PC</th>
                <th>PIC Name</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($test_venues as $test_venue)
                <tr>
                    <td>{{ $test_venue->id }}</td>
                    <td>{{ $test_venue->unit_number }}</td>
                    <td>{{ $test_venue->venue_name }}</td>
                    <td>{{ $test_venue->venue_short }}</td>
                    <td>{{ $test_venue->type }}</td>
                    <td>{{ $test_venue->capacity }}</td>
                    <td>{{ $test_venue->available_pc }}</td>
                    <td>{{ $test_venue->PICname }}</td>
                    <td>{{ $test_venue->PICphone_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection