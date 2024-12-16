<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeBeats - Staff Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('path/to/your/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardStaff.css') }}">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/js/app.js') 
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Header Section -->
        <header class="dashboard-header">
            <div class="header-content">
                <div class="logo">
                <a href="{{ route('dashboard.staff') }}" class="btn btn-secondary">DeBeats</a>
                </div>
                <div class="user-info">
                    <span>Welcome, {{ Auth::user()->name }}!</span>
                    <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
                </div>
            </div>
        </header>

        <!-- Main Content Section -->
        <div class="dashboard-container">
            <!-- Sidebar Menu -->
            <aside class="dashboard-sidebar">
                <nav>
                    <ul>
                        <li>
                            <a href="{{ route('add.exam.slot') }}">
                                <i class="icon-exam-slot"></i>
                                <span>Exam Slot</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/exam_list') }}">
                                <i class="icon-exam-list"></i>
                                <span>Exam List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('getConflictManagement') }}">
                                <i class="icon-conflict"></i>
                                <span>Conflict Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.staff.information') }}">
                                <i class="icon-info"></i>
                                <span>Information Details</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-test-list"></i>
                                <span>Test List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-calendar"></i>
                                <span>Google Calendar</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- Main Content Area -->
            <main class="dashboard-content">
           
                <section class="welcome-section">
                    <h2>Welcome to DeBeats Dashboard</h2>
                    <p>Manage exams, courses, and track your academic activities efficiently.</p>
                </section>
                @yield('content')
            </main>
        </div>

        <!-- Footer Section -->
        <footer class="dashboard-footer">
            <p>&copy; 2024 DeBeats. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Contact Support</a>
            </div>
        </footer>
    </div>
   
</body>
@yield('scripts')
</html>