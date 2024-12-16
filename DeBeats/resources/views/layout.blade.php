<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DeBeats')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardStaff.css') }}">
    @vite('resources/js/app.js')
</head>
<body>
    <!-- Header Section -->
    <header>
        <h1>DeBeats</h1>
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
    </header>

    <!-- Main Content Section -->
    <div class="container">
        <!-- Sidebar Menu -->
        <div class="sidebar">
            <ul>
                <li><a href="{{ route('add.exam.slot') }}">Exam Slot</a></li>
                <li><a href="{{ url('/exam_list') }}">Exam List</a></li>
                <li><a href="#">Conflict Management</a></li>
                <li><a href="{{ route('dashboard.staff.information') }}"> Information Details</a></li>
                <li><a href="#">Test List</a></li>
                <li><a href="#">Google Calendar</a></li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="content">
            @yield('content') <!-- Placeholder for child view content -->
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 DeBeats. All rights reserved.</p>
    </footer>
</body>
</html>
