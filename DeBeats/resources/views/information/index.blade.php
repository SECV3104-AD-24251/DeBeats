@extends ('layoutStaff')

@section('title', 'information')

@section('content')
<link rel="stylesheet" href="{{ asset('css/venueInfo.css') }}">
    <style>
        .container {
            display: flex;
            gap: 20px;
        }

        .card {
            width: 200px;
            height: 200px;
            background-color:rgb(231, 131, 23);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            text-align: center;
            font-size: 18px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <a href="{{ route('dashboard.staff.venues') }}">Venue Details</a>
        </div>
        <div class="card">
            <a href="{{ route('dashboard.staff.courses') }}">Course Details</a>
        </div>
        <div class="card">
            <a href="{{ route('dashboard.staff.student-registrations') }}">Student Registrations</a>
        </div>
        <div class="card">
            <a href="{{ route('dashboard.staff.lecturer') }}">Lecturers</a>
        </div>
        <div class="card">
            <a href="{{ route('dashboard.staff.test_venues') }}">Test Venues Details</a>
        </div>
    </div>
@endsection
