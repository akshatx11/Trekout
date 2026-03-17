// Modal Functions
function openModal(modalId) {
    document.getElementById(modalId + '-modal').style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId + '-modal').style.display = 'none';
}

function switchToSignup() {
    closeModal('login');
    openModal('signup');
}

function switchToLogin() {
    closeModal('signup');
    openModal('login');
}

// Auth Functions
function submitLogin(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Reload to update header
        } else {
            document.getElementById('login-error').textContent = data.error || 'Login failed';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('login-error').textContent = 'An error occurred. Please try again.';
    });
}

function submitSignup(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    // Validate password match
    const password = formData.get('password');
    const confirm = formData.get('confirm');
    
    if (password !== confirm) {
        document.getElementById('signup-error').textContent = 'Passwords do not match';
        return;
    }
    
    fetch('signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Account created successfully! Please login.');
            closeModal('signup');
            openModal('login');
        } else {
            document.getElementById('signup-error').textContent = data.error || 'Signup failed';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('signup-error').textContent = 'An error occurred. Please try again.';
    });
}

// Booking Functions
function openBookingModal(routeId) {
    const routeDetails = {
        1: { route: 'Delhi to Manali', operator: 'Himachal Travels', departure: '25 May, 2023 • 10:30 PM', duration: '12h 30m', price: '₹799', discount: '₹150', total: '₹649' },
        2: { route: 'Jaipur to Goa', operator: 'Kadamba Travels', departure: '28 May, 2023 • 9:00 PM', duration: '14h 15m', price: '₹899', discount: '₹170', total: '₹729' },
        3: { route: 'Mumbai to Delhi', operator: 'MSRTC', departure: '30 May, 2023 • 8:00 AM', duration: '3h 45m', price: '₹349', discount: '₹50', total: '₹299' },
        4: { route: 'Jaipur to Srinagar', operator: 'PRTC', departure: '1 June, 2023 • 7:30 AM', duration: '3h 15m', price: '₹299', discount: '₹40', total: '₹259' },
        5: { route: 'Hyderabad to Jaipur', operator: 'APSRTC', departure: '3 June, 2023 • 11:00 PM', duration: '12h 30m', price: '₹749', discount: '₹140', total: '₹609' },
        6: { route: 'Kolkata to Bangalore', operator: 'North Bengal Travels', departure: '5 June, 2023 • 10:00 PM', duration: '14h 45m', price: '₹899', discount: '₹170', total: '₹729' }
    };

    const route = routeDetails[routeId];

    document.getElementById('summary-route').textContent = route.route;
    document.getElementById('summary-operator').textContent = route.operator;
    document.getElementById('summary-departure').textContent = route.departure;
    document.getElementById('summary-duration').textContent = route.duration;

    let seats = 1;
    const passengersElement = document.getElementById('passengers');
    if (passengersElement) {
        seats = passengersElement.value;
    }
    document.getElementById('summary-seats').textContent = seats;

    openModal('booking');
    addSeatEventListeners();
}

var currentStep = 1;
var selectedSeats = [];

function nextStep(step) {
    if (step === 1) {
        // Validate passenger details
        const name = document.getElementById('passenger-name').value;
        const age = document.getElementById('passenger-age').value;
        const gender = document.getElementById('passenger-gender').value;
        const email = document.getElementById('passenger-email').value;
        const phone = document.getElementById('passenger-phone').value;
        const studentId = document.getElementById('student-id-booking').value;

        if (name && age && gender && email && phone && studentId) {
            if (phone.length === 10) {
                document.getElementById('passenger-step').style.display = 'none';
                document.getElementById('seat-step').style.display = 'block';
                document.getElementById('step2').classList.add('active');
                currentStep = 2;
            } else {
                alert('Please enter a valid 10-digit phone number');
            }
        } else {
            alert('Please fill in all passenger details');
        }
    } else if (step === 2) {
        // Validate at least one seat is selected
        if (selectedSeats.length > 0) {
            document.getElementById('seat-step').style.display = 'none';
            document.getElementById('payment-step').style.display = 'block';
            document.getElementById('step3').classList.add('active');
            currentStep = 3;
            
            // Update seat summary
            document.getElementById('summary-seats').textContent = selectedSeats.length + ' seat(s)';
            document.getElementById('summary-total-amount').textContent = '₹' + (649 * selectedSeats.length);
        } else {
            alert('Please select at least one seat');
        }
    }
}

function prevStep(step) {
    if (step === 2) {
        document.getElementById('seat-step').style.display = 'none';
        document.getElementById('passenger-step').style.display = 'block';
        document.getElementById('step2').classList.remove('active');
        currentStep = 1;
    } else if (step === 3) {
        document.getElementById('payment-step').style.display = 'none';
        document.getElementById('seat-step').style.display = 'block';
        document.getElementById('step3').classList.remove('active');
        currentStep = 2;
    }
}

function selectSeat(element) {
    const seatNumber = element.getAttribute('data-seat-number');
    console.log('selectSeat called for seat:', seatNumber);
    if (!element.classList.contains('booked')) {
        if (element.classList.contains('selected')) {
            // Deselect seat
            element.classList.remove('selected');
            selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
        } else {
            // Select seat
            element.classList.add('selected');
            selectedSeats.push(seatNumber);
        }
        
        // Update seat display
        updateSelectedSeatsDisplay();
        
        // Update booking summary
        updateBookingSummary();
    }
}

function updateSelectedSeatsDisplay() {
    const selectedSeatsText = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'None';
    console.log('Selected seats:', selectedSeatsText);
    
    // Update the seat count in booking summary
    const seatCountElement = document.getElementById('summary-seats');
    if (seatCountElement) {
        seatCountElement.textContent = selectedSeats.length + ' seat(s)';
    }
}

function updateBookingSummary() {
    const baseFare = 649;
    const totalAmount = baseFare * selectedSeats.length;
    
    const totalAmountElement = document.getElementById('summary-total-amount');
    const paymentTotalElement = document.getElementById('payment-total-amount');
    
    if (totalAmountElement) {
        totalAmountElement.textContent = '₹' + totalAmount;
    }
    if (paymentTotalElement) {
        paymentTotalElement.textContent = '₹' + totalAmount;
    }
}

function addSeatEventListeners() {
    const seats = document.querySelectorAll('.seat:not(.booked)');
    console.log('Adding event listeners to seats:', seats.length);
    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            console.log('Seat clicked:', seat.getAttribute('data-seat-number'));
            selectSeat(seat);
        });
    });
}

// Initialize seat selection on page load
document.addEventListener('DOMContentLoaded', function() {
    selectedSeats = [];
    updateSelectedSeatsDisplay();
    addSeatEventListeners();
});

function selectPayment(method) {
    // Remove selected class from all payment options
    document.querySelectorAll('.payment-option').forEach(option => {
        option.classList.remove('selected');
    });

    // Add selected class to clicked option
    event.target.closest('.payment-option').classList.add('selected');

    // Show corresponding form
    document.getElementById('upi-form').style.display = 'none';
    document.getElementById('card-form').style.display = 'none';

    if (method === 'upi') {
        document.getElementById('upi-form').style.display = 'block';
    } else if (method === 'card') {
        document.getElementById('card-form').style.display = 'block';
    }
}

// ...existing code...

// Paste these functions right above processPayment()
function formatDate(dateStr) {
    const parts = dateStr.replace(',', '').split(' ');
    const months = {
        'January': '01', 'February': '02', 'March': '03', 'April': '04',
        'May': '05', 'June': '06', 'July': '07', 'August': '08',
        'September': '09', 'October': '10', 'November': '11', 'December': '12'
    };
    return `${parts[2]}-${months[parts[1]]}-${parts[0].padStart(2, '0')}`;
}

function formatTime(timeStr) {
    let [time, period] = timeStr.split(' ');
    let [hour, minute] = time.split(':');
    hour = parseInt(hour, 10);
    if (period === 'PM' && hour < 12) hour += 12;
    if (period === 'AM' && hour === 12) hour = 0;
    return `${hour.toString().padStart(2, '0')}:${minute}:00`;
}

function processPayment() {
    // Collect booking data
    const bookingData = {
        passenger_name: document.getElementById('passenger-name').value,
        passenger_age: document.getElementById('passenger-age').value,
        passenger_gender: document.getElementById('passenger-gender').value,
        passenger_email: document.getElementById('passenger-email').value,
        passenger_phone: document.getElementById('passenger-phone').value,
        student_id: document.getElementById('student-id-booking').value,
        route_name: document.getElementById('summary-route').textContent,
        operator: document.getElementById('summary-operator').textContent,
        departure_date: formatDate(document.getElementById('summary-departure').textContent.split(' • ')[0]),
        departure_time: formatTime(document.getElementById('summary-departure').textContent.split(' • ')[1]),
        seats: selectedSeats.join(', '),
        total_amount: parseFloat(document.getElementById('summary-total-amount').textContent.replace('₹', ''))
    };

    // Send booking data to server
    fetch('save_booking.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(bookingData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update confirmation details with actual booking ID
            document.getElementById('conf-booking-id').textContent = data.booking_id;
            document.getElementById('conf-passenger-name').textContent = bookingData.passenger_name;
            document.getElementById('conf-seats').textContent = selectedSeats.join(', ');
            document.getElementById('conf-route').textContent = bookingData.route_name;
            document.getElementById('conf-departure').textContent = bookingData.departure_date + ' • ' + bookingData.departure_time;
            document.getElementById('conf-amount-paid').textContent = '₹' + bookingData.total_amount;
            
            // Update the e-ticket link with actual booking ID
            const eticketLink = document.querySelector('#confirmation-step .confirmation-btn');
            if (eticketLink) {
                eticketLink.href = 'eticket.php?booking_id=' + data.booking_id;
            }
            
            // Show confirmation step
            document.getElementById('payment-step').style.display = 'none';
            document.getElementById('confirmation-step').style.display = 'block';
            document.getElementById('step4').classList.add('active');
            currentStep = 4;
        } else {
            alert('Error saving booking: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while processing your booking. Please try again.');
    });

}
