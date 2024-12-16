@extends('layoutStudent') <!-- Extends the layout -->

@section('title', 'Course Registration') <!-- Matches @yield('title') in the layout -->

@section('content')
    <style>
        /* Basic body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            background-color: #f9f9f9;
        }

        /* Center the main content and elevate it a bit */
        .content {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 10px -10px 20px rgba(0, 0, 0, 0.1), -10px 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Header style */
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 300px; /* Adjust logo size */
            height: auto;
            margin-right: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        /* Table Styling */
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid black;
            text-align: center;
        }

        th {
            background-color:rgb(240, 240, 240);
        }

        /* Title and description */
        h1, h3 {
            margin: 10px 0;
        }
    </style>

    <!-- Main content block -->
    <div class="content">
        <!-- Header with logo and text -->
        <div class="header">
            <img src="{{ asset('images/utm.jpg') }}" alt="University Logo"/>
            <div>
                <h2>UNIVERSITI TEKNOLOGI MALAYSIA</h2>
                <p>ACADEMIC MANAGEMENT DIVISION (UNDERGRADUATE)</p>
                <p>81310 UTM JOHOR BAHRU, JOHOR, MALAYSIA</p>
            </div>
        </div>

        <!-- Course Registration Slip Header -->
        <h1>Course Registration Slip</h1>
        <h3>Faculty: Faculty of Computing</h3>
        <h3>Programme: Bachelor of Software Graphics and Multimedia (SECVH)</h3>
        <br>
        <h3>Name: {{ $studentName }}</h3>
        <h3>UtmID: {{ $UTMID }}</h3>

        <!-- Centered Table with serial numbers -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $index => $course)
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Serial number -->
                        <td>{{ $course->course_code }}</td>
                        <td>{{ $course->course_name }}</td>  <!-- Assuming 'name' is the course name in 'courses' table -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <p>Note: Please check your name and registered course. Corrections can be made at your faculty/school.</p>
    </div>
@endsection
