@extends ('layoutStaff')

@section('title', 'information')

@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Course Information</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Course g Name</th>
                <th>Course Code</th>
                <th>Capacity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->capacity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection