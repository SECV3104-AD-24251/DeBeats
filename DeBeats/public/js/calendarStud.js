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
    calendarGrid.innerHTML = '';  // Clear grid

    const year = date.getFullYear();
    const month = date.getMonth();

    // Update the month-year header
    monthYear.textContent = '${monthNames[month]} ${year}';

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
renderCalendar(currentDate)