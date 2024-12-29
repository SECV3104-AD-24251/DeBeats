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
            background-color: rgb(231, 131, 23);
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
            <a href="{{ route('dashboard.lecturer.venues') }}">Venue Details</a>
        </div>
        <div class="card">
            <a href="{{ route('dashboard.lecturer.test_venues') }}">Test Venue Details</a>
        </div>
    </div>
@endsection
