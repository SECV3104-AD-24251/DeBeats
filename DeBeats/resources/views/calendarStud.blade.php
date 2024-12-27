<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    
    
    <title>Calendar</title>
</head>
<body>
    <div class="calendar-container">
        <!-- Calendar Header -->
        <div class="calendar-header">
            <h1 id="monthYear">December 2024</h1> <!-- The month-year header that will be dynamically updated -->
            <div class="navigation">
                <button id="prevBtn">&lt; Prev</button> <!-- Button to go to the previous month -->
                <button id="nextBtn">Next &gt;</button> <!-- Button to go to the next month -->
            </div>
        </div>

        <!-- Days of the Week -->
        <div class="calendar-days">
            <div class="day">Sun</div>
            <div class="day">Mon</div>
            <div class="day">Tue</div>
            <div class="day">Wed</div>
            <div class="day">Thu</div>
            <div class="day">Fri</div>
            <div class="day">Sat</div>
        </div>

        <!-- Calendar Grid for Dates -->
        <div class="calendar-grid" id="calendarGrid"></div> <!-- This grid will be dynamically populated -->
    </div>

    <!-- Include JavaScript -->
    <script src="{{ asset('js/calendarStud.js') }}"></script>
</body>
</html>