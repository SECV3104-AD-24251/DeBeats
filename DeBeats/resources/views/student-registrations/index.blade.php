@extends ('layoutStaff')

@section('title', 'information')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Student Registrations</h1>

    <!-- Search Form -->
    <form action="{{ route('staff.student-registrations.search') }}" method="GET">
        <label for="UTMID">Enter UTM ID:</label>
        <input type="text" name="UTMID" id="UTMID" required>
        <button type="submit">Search</button>
    </form>

    <!-- Display the search results if available -->
    @if (isset($studentCourses))
        <h3>Courses Registered by {{ $studentCourses['student_name'] }} ({{ $studentCourses['UTMID'] }})</h3>

        <table>
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentCourses['courses'] as $course)
                    <tr>
                        <td>{{ $course['course_code'] }}</td>
                        <td>{{ $course['course_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <!-- Display all courses with registered students if no search is performed -->
        <h3>All Courses and Registered Students</h3>

        <table>
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Registered Students</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course['course_code'] }}</td>
                        <td>{{ $course['course_name'] }}</td>
                        <td>
                            <ul>
                                @foreach ($course['students'] as $student)
                                    <li>{{ $student['student_name'] }} ({{ $student['UTMID'] }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
