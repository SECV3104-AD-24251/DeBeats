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

    // Object to store the exam slots for each day
    const examsByDate = {};

    // Fetch student's exams for this month
    fetch(`/get-student-exams/${month + 1}/${year}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(examSlots => {
            examSlots.forEach(exam => {
                const examDate = new Date(exam.exam_date);
                const examDay = examDate.getDate();

                // Initialize array for this date if it doesn't exist
                if (!examsByDate[examDay]) {
                    examsByDate[examDay] = [];
                }
                examsByDate[examDay].push(exam);
            });

            // Render days of the current month
            renderDays(firstDay, lastDate, prevLastDate, examsByDate, month, year);
        })
        .catch(error => {
            console.error('Error fetching student exams:', error);
            alert('Could not fetch exams. Displaying the calendar without exam data.');
            // Render calendar without exams if fetch fails
            renderDays(firstDay, lastDate, prevLastDate, {}, month, year);
        });
}

// Function to render days of the calendar
function renderDays(firstDay, lastDate, prevLastDate, examsByDate, month, year) {
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

        // Add exams for this date
        if (examsByDate[i]) {
            examsByDate[i].forEach(exam => {
                const examEvent = document.createElement('div');
                examEvent.classList.add('exam-event');
                examEvent.textContent = exam.course_code;

                // Add click event to show popup
                examEvent.addEventListener('click', (e) => {
                    e.stopPropagation();
                    showPopup(exam);
                });

                dateCell.appendChild(examEvent);
            });
        }

        calendarGrid.appendChild(dateCell);
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

// Function to show exam details popup
function showPopup(exam) {
    // Remove any existing popups
    const existingPopup = document.querySelector('.popup');
    if (existingPopup) existingPopup.remove();

    // Create the popup element
    const popup = document.createElement('div');
    popup.classList.add('popup');

    // Add content to the popup
    popup.innerHTML = `
        <div class="popup-content">
            <h4>Exam Details</h4>
            <p><strong>Course Name:</strong> ${exam.course_name}</p>
            <p><strong>Course Code:</strong> ${exam.course_code}</p>
            <p><strong>Start Time:</strong> ${exam.start_time}</p>
            <p><strong>End Time:</strong> ${exam.end_time}</p>
            <p><strong>Venue:</strong> ${exam.venue_short}</p>
            <button class="close-popup">Close</button>
        </div>
    `;

    // Append the popup to the body
    document.body.appendChild(popup);

    // Add event listener to close the popup
    const closeButton = popup.querySelector('.close-popup');
    closeButton.addEventListener('click', () => popup.remove());
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
