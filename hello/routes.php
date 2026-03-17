
<?php
session_start();
// var_dump($_SESSION['username']); // Debug: Remove after testing
?>
<?php include 'header.php'; ?>
<script src="script1.js"></script>

    <main>
        <section class="hero" style="padding: 100px 0 50px;">
            <h1 style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Popular Student Routes</h1>
            <p>Discover the most popular bus routes for students across India with special discounts.</p>
        </section>

        <section class="popular-routes" id="routes">
            <h2 class="section-title" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Popular Student Routes</h2>
            <div class="routes-grid">
                <div class="route-card">
                    <div class="route-image">
                        <img src="manali.png" alt="Scenic view of Manali mountains with snow peaks and valley">
                    </div>
                    <div class="route-details">
                        <h3 class="route-title">Delhi to Manali</h3>
                        <div class="route-info">
                            <span class="route-duration">12h 30m</span>
                            <span class="route-operator">Himachal Travels</span>
                        </div>
                        <div class="route-price">₹799</div>
                        <!-- <button class="book-btn" onclick="openBookingModal(1)">Book Now</button> -->

<?php if(isset($_SESSION['username'])): ?>
    <button class="book-btn" onclick="openBookingModal(1)">Book Now</button>
<?php else: ?>
    <button class="book-btn" onclick="alert('Please login or sign up to book your ticket!')">Book Now</button>
<?php endif; ?>
                    </div>
                </div>

                <div class="route-card">
                    <div class="route-image">
                        <img src="goa.png" alt="Beautiful beaches of Goa with palm trees and golden sand">
                    </div>
                    <div class="route-details">
                        <h3 class="route-title">Jaipur to Goa</h3>
                        <div class="route-info">
                            <span class="route-duration">14h 15m</span>
                            <span class="route-operator">Kadamba Travels</span>
                        </div>
                        <div class="route-price">₹899</div>
                        <!-- <button class="book-btn" onclick="openBookingModal(2)">Book Now</button> -->

<?php if(isset($_SESSION['username'])): ?>
    <button class="book-btn" onclick="openBookingModal(2)">Book Now</button>
<?php else: ?>
    <button class="book-btn" onclick="alert('Please login or sign up to book your ticket!')">Book Now</button>
<?php endif; ?>
                    </div>
                </div>

                <div class="route-card">
                    <div class="route-image">
                        <img src="delhi.png" alt="Modern Expressway connecting Mumbai and Pune with mountains">
                    </div>
                    <div class="route-details">
                        <h3 class="route-title">Mumbai to Delhi</h3>
                        <div class="route-info">
                            <span class="route-duration">3h 45m</span>
                            <span class="route-operator">MSRTC</span>
                        </div>
                        <div class="route-price">₹349</div>
                        <!-- <button class="book-btn" onclick="openBookingModal(3)">Book Now</button> -->
                         <?php if(isset($_SESSION['username'])): ?>
    <button class="book-btn" onclick="openBookingModal(3)">Book Now</button>
<?php else: ?>
    <button class="book-btn" onclick="alert('Please login or sign up to book your ticket!')">Book Now</button>
<?php endif; ?>
                    </div>
                </div>

                <div class="route-card">
                    <div class="route-image">
                        <img src="srinagar.png" alt="French architecture in Pondicherry with coastal road">
                    </div>
                    <div class="route-details">
                        <h3 class="route-title">Jaipur to Srinagar</h3>
                        <div class="route-info">
                            <span class="route-duration">3h 15m</span>
                            <span class="route-operator">PRTC</span>
                        </div>
                        <div class="route-price">₹299</div>
                        <!-- <button class="book-btn" onclick="openBookingModal(4)">Book Now</button> -->
                         <?php if(isset($_SESSION['username'])): ?>
    <button class="book-btn" onclick="openBookingModal(4)">Book Now</button>
<?php else: ?>
    <button class="book-btn" onclick="alert('Please login or sign up to book your ticket!')">Book Now</button>
<?php endif; ?>
                    </div>
                </div>

                <div class="route-card">
                    <div class="route-image">
                        <img src="jaipur.png" alt="Coastal city vista of Vizag with beaches and hills">
                    </div>
                    <div class="route-details">
                        <h3 class="route-title">Hyderabad to Jaipur</h3>
                        <div class="route-info">
                            <span class="route-duration">12h 30m</span>
                            <span class="route-operator">APSRTC</span>
                        </div>
                        <div class="route-price">₹749</div>
                        <!-- <button class="book-btn" onclick="openBookingModal(5)">Book Now</button> -->
                         <?php if(isset($_SESSION['username'])): ?>
    <button class="book-btn" onclick="openBookingModal(5)">Book Now</button>
<?php else: ?>
    <button class="book-btn" onclick="alert('Please login or sign up to book your ticket!')">Book Now</button>
<?php endif; ?>
                    </div>
                </div>

                <div class="route-card">
                    <div class="route-image">
                        <img src="banglore.png" alt="Tea gardens of Darjeeling with Himalayan backdrop">
                    </div>
                    <div class="route-details">
                        <h3 class="route-title">Kolkata to Bangalore</h3>
                        <div class="route-info">
                            <span class="route-duration">14h 45m</span>
                            <span class="route-operator">North Bengal Travels</span>
                        </div>
                        <div class="route-price">₹899</div>
                        <!-- <button class="book-btn" onclick="openBookingModal(6)">Book Now</button> -->
                         <?php if(isset($_SESSION['username'])): ?>
    <button class="book-btn" onclick="openBookingModal(6)">Book Now</button>
<?php else: ?>
    <button class="book-btn" onclick="alert('Please login or sign up to book your ticket!')">Book Now</button>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        
            <div id="booking-modal" class="modal">
        <div class="modal-content booking-modal-content">
<span class="close-modal" onclick="closeModal('booking-modal')">&times;</span>

            <div class="booking-steps">
                <div class="booking-step active" id="step1">
                    <div class="step-number">1</div>
                    <div class="step-name">Passenger Details</div>
                </div>
                <div class="booking-step" id="step2">
                    <div class="step-number">2</div>
                    <div class="step-name">Seat Selection</div>
                </div>
                <div class="booking-step" id="step3">
                    <div class="step-number">3</div>
                    <div class="step-name">Payment</div>
                </div>
                <div class="booking-step" id="step4">
                    <div class="step-number">4</div>
                    <div class="step-name">Confirmation</div>
                </div>
            </div>

            <div id="passenger-step">
                <h3 class="form-section-title">Passenger Information</h3>
                <div class="passenger-form">
                    <div class="form-group-modal">
                        <label for="passenger-name">Full Name</label>
                        <input type="text" id="passenger-name" placeholder="As per ID card" required>
                    </div>
                    <div class="form-group-modal">
                        <label for="passenger-age">Age</label>
                        <input type="number" id="passenger-age" min="16" max="30" required>
                    </div>
                    <div class="form-group-modal">
                        <label for="passenger-gender">Gender</label>
                        <select id="passenger-gender" required>
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group-modal">
                        <label for="passenger-email">Email</label>
                        <input type="email" id="passenger-email" placeholder="For ticket confirmation" required>
                    </div>
                    <div class="form-group-modal">
                        <label for="passenger-phone">Phone Number</label>
                        <input type="tel" id="passenger-phone" placeholder="10-digit mobile number" required>
                    </div>
                    <div class="form-group-modal">
                        <label for="student-id-booking">Student ID</label>
                        <input type="text" id="student-id-booking" placeholder="For discount verification" required>
                    </div>
                </div>

                <h3 class="form-section-title">Booking Summary</h3>
                <div class="booking-summary">
                    <div class="summary-item">
                        <span class="summary-title">Route:</span>
                        <span class="summary-value" id="summary-route"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Operator:</span>
                        <span class="summary-value" id="summary-operator"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Departure:</span>
                        <span class="summary-value" id="summary-departure"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Duration:</span>
                        <span class="summary-value" id="summary-duration"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Seats:</span>
                        <span class="summary-value" id="summary-seats">1 (Default)</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Base Fare:</span>
                        <span class="summary-value" id="summary-base-fare"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Student Discount:</span>
                        <span class="summary-value" id="summary-discount"></span>
                    </div>
                    <div class="total">
                        <span class="summary-title">Total Amount:</span>
                        <span class="summary-value" id="summary-total-amount"></span>
                    </div>
                </div>

                <div class="stepper-navigation">
                    <button class="prev-btn" disabled>Previous</button>
                    <button class="next-btn" onclick="nextStep(1)">Next: Select Seats</button>
                </div>
            </div>

            <div id="seat-step" style="display: none;">
                <h3 class="form-section-title">Select Your Seats</h3>
                <p>Please choose your preferred seats from the available options below.</p>
                <div class="seat-selection">
                    <div class="seat-grid" id="seat-grid">
<div class="seat" data-seat-number="1">1</div>
<div class="seat" data-seat-number="2">2</div>
<div class="seat booked" data-seat-number="3">3</div>
<div class="seat booked" data-seat-number="4">4</div>
<div class="seat" data-seat-number="5">5</div>
<div class="seat" data-seat-number="6">6</div>
<div class="seat booked" data-seat-number="7">7</div>
<div class="seat" data-seat-number="8">8</div>
<div class="seat" data-seat-number="9">9</div>
<div class="seat" data-seat-number="10">10</div>
<div class="seat" data-seat-number="11">11</div>
<div class="seat" data-seat-number="12">12</div>
<div class="seat booked" data-seat-number="13">13</div>
<div class="seat" data-seat-number="14">14</div>
<div class="seat" data-seat-number="15">15</div>
<div class="seat" data-seat-number="16">16</div>
<div class="seat booked" data-seat-number="17">17</div>
<div class="seat" data-seat-number="18">18</div>
<div class="seat" data-seat-number="19">19</div>
<div class="seat" data-seat-number="20">20</div>
                    </div>
                </div>

                <div class="stepper-navigation">
                    <button class="prev-btn" onclick="prevStep(2)">Previous</button>
                    <button class="next-btn" onclick="nextStep(2)">Next: Payment</button>
                </div>
            </div>

            <div id="payment-step" style="display: none;">
                <h3 class="form-section-title">Payment Options</h3>
                <p>Select your preferred payment method to complete the booking.</p>

                <div class="payment-options">
                    <div class="payment-option selected" data-payment-method="upi" onclick="selectPayment('upi')">
                        <div class="payment-icon">💳</div>
                        <div class="payment-name">UPI</div>
                    </div>
                    <div class="payment-option" data-payment-method="card" onclick="selectPayment('card')">
                        <div class="payment-icon">💳</div>
                        <div class="payment-name">Credit/Debit Card</div>
                    </div>
                    <div class="payment-option" data-payment-method="netbanking" onclick="selectPayment('netbanking')">
                        <div class="payment-icon">🏦</div>
                        <div class="payment-name">Net Banking</div>
                    </div>
                    <div class="payment-option" data-payment-method="wallet" onclick="selectPayment('wallet')">
                        <div class="payment-icon">💰</div>
                        <div class="payment-name">Wallet</div>
                    </div>
                </div>

                <div id="upi-form" style="margin-top: 2rem;">
                    <div class="form-group-modal">
                        <label for="upi-id">UPI ID</label>
                        <input type="text" id="upi-id" placeholder="yourname@upi" required>
                    </div>
                    <button class="submit-btn" onclick="processPayment()">Pay Now</button>
                </div>

                <div id="card-form" style="display: none; margin-top: 2rem;">
                    <div class="form-group-modal">
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <div class="form-group-modal">
                        <label for="card-name">Name on Card</label>
                        <input type="text" id="card-name" placeholder="As on card" required>
                    </div>
                    <div class="form-group-modal">
                        <label for="card-expiry">Expiry Date</label>
                        <input type="text" id="card-expiry" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group-modal">
                        <label for="card-cvv">CVV</label>
                        <input type="text" id="card-cvv" placeholder="123" required>
                    </div>
                    <button class="submit-btn" onclick="processPayment()">Pay Now</button>
                </div>

                <div class="booking-summary mt-4">
                    <div class="summary-item">
                        <span class="summary-title">Total Amount:</span>
                        <span class="summary-value" id="payment-total-amount">₹649</span>
                    </div>
                </div>

                <div class="stepper-navigation">
                    <button class="prev-btn" onclick="prevStep(3)">Previous</button>
                </div>
            </div>

            <div id="confirmation-step" style="display: none;">
                <div class="confirmation-icon">✅</div>
                <h3 class="confirmation-title">Booking Confirmed!</h3>
                <p class="confirmation-text">Your trip has been successfully booked. Your e-ticket has been sent to your email.</p>

                <div class="confirmation-details">
                    <div class="summary-item">
                        <span class="summary-title">Booking ID:</span>
                        <span class="summary-value" id="conf-booking-id"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Passenger:</span>
                        <span class="summary-value" id="conf-passenger-name"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Seats:</span>
                        <span class="summary-value" id="conf-seats"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Route:</span>
                        <span class="summary-value" id="conf-route"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Departure:</span>
                        <span class="summary-value" id="conf-departure"></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Pickup Point:</span>
                        <span class="summary-value" id="conf-pickup-point">Kashmere Gate Bus Terminal</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-title">Amount Paid:</span>
                        <span class="summary-value" id="conf-amount-paid"></span>
                    </div>
                </div>

<a href="eticket.php" class="confirmation-btn btn btn-primary" >View E-Ticket</a>
            </div>
        </div>
    </div>

    </main>

<?php include 'footer.php'; ?>
