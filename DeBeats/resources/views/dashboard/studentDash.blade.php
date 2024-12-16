<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeBeats - Student Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('path/to/your/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardStaff.css') }}">

    @vite('resources/js/app.js') 
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Header Section -->
        <header class="dashboard-header">
            <div class="header-content">
                <div class="logo">
                <a href="{{ route('dashboard.student') }}" class="btn btn-secondary">DeBeats</a>
                </div>
                <div class="user-info">
                    <span>Welcome, {{ Auth::user()->name }}!</span>
                    <a href="{{ route('logout') }}" method="POST" class="logout-btn">Logout</a>
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
                        <a href="{{ route('getStudentExamList') }}">
                                <i class="icon-exam-slot"></i>
                                <span>Exam List</span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('getClashReport') }}">
                                <i class="icon-exam-list"></i>
                                <span>Clash Report</span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('getStatusClashReport') }}">
                                <i class="icon-conflict"></i>
                                <span>Status Clash Report</span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('getCourseRegistrationSlip') }}">
                                <i class="icon-info"></i>
                                <span>Registration Slip</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- Main Content Area -->
            <main class="dashboard-content">
                <section class="welcome-section">
                    <h2>Welcome to Student Dashboard</h2>
                </section>

                <section class="calendar-section">
                    @include('calendar')
                </section>

                <!-- Optional: Quick Action Buttons -->
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
</html>