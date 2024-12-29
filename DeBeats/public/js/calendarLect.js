const monthYear = document.getElementById('monthYear');
const calendarGrid = document.getElementById('calendarGrid');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

// Ensure essential elements exist
if (!monthYear || !calendarGrid || !prevBtn || !nextBtn) {
    console.error("Missing essential calendar elements in the DOM.");
    throw new Error("Required calendar elements are not found.");
}

// Month names for display
const monthNames = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];

// Initialize current date
let currentDate = new Date();

// Function to render the calendar
function renderCalendar(date) {
    calendarGrid.innerHTML = ''; // Clear grid

    const year = date.getFullYear();
    const month = date.getMonth();

    // Update the month-year header
    monthYear.textContent = `${monthNames[month]} ${year}`;

    // Get the first and last days of the current month
    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();
    const prevLastDate = new Date(year, month, 0).getDate();

    // Add previous month's trailing dates
    for (let i = firstDay; i > 0; i--) {
        const prevDate = document.createElement('div');
        prevDate.classList.add('date', 'faded');
        prevDate.textContent = prevLastDate - i + 1;
        calendarGrid.appendChild(prevDate);
    }

    // Add current month's dates
    for (let i = 1; i <= lastDate; i++) {
        const dateCell = document.createElement('div');
        dateCell.classList.add('date');
        dateCell.textContent = i;

        // Highlight today's date
        const today = new Date();
        if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
            dateCell.classList.add('today');
        }

        // Add click event listener to redirect or fetch test slots
        // Add click event listener to redirect or fetch test slots
dateCell.addEventListener('click', () => {
    const selectedDate = new Date(year, month, i);
    if (selectedDate < today.setHours(0, 0, 0, 0)) {
        alert("You cannot add test slots for past dates.");
        return; // Prevent redirection for past dates
    }

    // Check if the selected day is Friday (5) or Saturday (6)
    const dayOfWeek = selectedDate.getDay(); // 0=Sunday, 1=Monday, ..., 5=Friday, 6=Saturday
    if (dayOfWeek === 5 || dayOfWeek === 6) {
        alert("You cannot select a Friday or Saturday as the exam date.");
        $(this).val('');
    } 
    // Adjust the date to UTC before formatting
    const utcDate = new Date(Date.UTC(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate()));

    // Format the date as YYYY-MM-DD
    const formattedDate = utcDate.toISOString().split('T')[0];

    // Redirect to add-test-slot with selected date
    window.location.href = `/add-test-slot?date=${formattedDate}`;
});

        // Fetch and add test slots for this date
        fetch(`/fetch-tests?month=${month + 1}&year=${year}`)
        .then(response => response.json())
        .then(data => {
            const testForDate = data.find(test => {
                const testDate = new Date(test.exam_date);
                return testDate.getDate() === i && testDate.getMonth() === month && testDate.getFullYear() === year;
            });

            if (testForDate) {
                const examEvent = document.createElement('div');
                examEvent.classList.add('test-event');
                examEvent.textContent = testForDate.course_code;
                dateCell.appendChild(examEvent);

                // Add popup on click
                examEvent.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent triggering parent click event
                    showPopup(testForDate);
                });
            }
        });

        calendarGrid.appendChild(dateCell);
    }



// Function to show the popup with exam details
function showPopup(test) {
    const popup = document.createElement('div');
    popup.classList.add('popup');
    popup.innerHTML = `
        <div class="popup-content">
            <h4>Exam Details</h4>
            <p><strong>Course Name:</strong> ${test.course_name}</p>
            <p><strong>Duration:</strong> ${test.duration}</p>
            <p><strong>Venue:</strong> ${test.venue_short}</p>
            <button class="close-popup">Close</button>
        </div>
    `;

    // Append the popup to the body
    document.body.appendChild(popup);

    // Add event listener to close the popup
    popup.querySelector('.close-popup').addEventListener('click', () => {
        popup.remove();
    });
}

    

    // Add next month's leading dates
    const totalCells = calendarGrid.children.length;
    for (let i = 1; i <= 42 - totalCells; i++) {
        const nextDate = document.createElement('div');
        nextDate.classList.add('date', 'faded');
        nextDate.textContent = i;
        calendarGrid.appendChild(nextDate);
    }
}

// Event handlers for navigation buttons
prevBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

nextBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

// Render the calendar initially
renderCalendar(currentDate);