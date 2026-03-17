<?php
session_start();
include 'db.php';

// Check login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Step 1: Get booking_id from URL, session, or last booking in DB
if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];
} elseif (isset($_SESSION['booking_id'])) {
    $bookingId = $_SESSION['booking_id'];
} else {
    // Fetch the latest booking for this user
    $stmt = mysqli_prepare($conn, "SELECT booking_id FROM booking WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $bookingId = $row['booking_id'];
    } else {
        $bookingId = null;
    }
    mysqli_stmt_close($stmt);
}

// Step 2: If no booking found, show message
if (!$bookingId) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>No Booking Found</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="alert alert-warning text-center">
                <h2>No Booking Found</h2>
                <p>We couldn't find any booking associated with your account.</p>
                <div class="mt-3">
                    <a href="index.php" class="btn btn-primary">Book New Ticket</a>
                    <a href="routes.php" class="btn btn-secondary">View Routes</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Step 3: Fetch booking details
$sql = "SELECT * FROM booking WHERE booking_id = ? AND user_id = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $bookingId, $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) === 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Booking Not Found</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="alert alert-danger text-center">
                <h2>Booking Not Found</h2>
                <p>The booking you're looking for doesn't exist or doesn't belong to your account.</p>
                <div class="mt-3">
                    <a href="index.php" class="btn btn-primary">Book New Ticket</a>
                    <a href="routes.php" class="btn btn-secondary">View Routes</a>
                    <a href="javascript:history.back()" class="btn btn-outline-secondary">Go Back</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

$bookingDetails = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
?>

<!-- Ticket HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>E-Ticket - <?= htmlspecialchars($bookingDetails['booking_id']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .ticket-card {
            max-width: 800px;
            margin: 50px auto;
            padding: 25px;
            border: 2px solid #0d6efd;
            border-radius: 15px;
            background-color: white;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }
        .ticket-header {
            border-bottom: 2px dashed #ccc;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .ticket-header h2 {
            color: #0d6efd;
            font-weight: bold;
        }
        .ticket-section {
            margin-bottom: 20px;
        }
        .ticket-label {
            font-weight: bold;
            color: #555;
        }
        .highlight {
            background-color: #e9f5ff;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .ticket-footer {
            border-top: 2px dashed #ccc;
            padding-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .btn-print {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
        }
        .btn-print:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>

<div class="ticket-card">
    <div class="ticket-header text-center">
        <h2>🎫 E-Ticket</h2>
        <p><strong>Booking ID:</strong> <span class="highlight"><?= htmlspecialchars($bookingDetails['booking_id']) ?></span></p>
    </div>

    <div class="ticket-section">
        <h5>👤 Passenger Details</h5>
        <p><span class="ticket-label">Name:</span> <?= htmlspecialchars($bookingDetails['passenger_name']) ?></p>
        <p><span class="ticket-label">Age:</span> <?= htmlspecialchars($bookingDetails['passenger_age']) ?> years</p>
        <p><span class="ticket-label">Gender:</span> <?= htmlspecialchars($bookingDetails['passenger_gender']) ?></p>
        <p><span class="ticket-label">Email:</span> <?= htmlspecialchars($bookingDetails['passenger_email']) ?></p>
        <p><span class="ticket-label">Phone:</span> <?= htmlspecialchars($bookingDetails['passenger_phone']) ?></p>
    </div>

    <div class="ticket-section">
        <h5>🚌 Trip Details</h5>
        <p><span class="ticket-label">Route:</span> <?= htmlspecialchars($bookingDetails['route_name']) ?></p>
        <p><span class="ticket-label">Operator:</span> <?= htmlspecialchars($bookingDetails['operator']) ?></p>
        <p><span class="ticket-label">Date:</span> <?= htmlspecialchars($bookingDetails['departure_date']) ?></p>
        <p><span class="ticket-label">Time:</span> <?= htmlspecialchars($bookingDetails['departure_time']) ?></p>
        <p><span class="ticket-label">Seats:</span> <?= htmlspecialchars($bookingDetails['seats']) ?></p>
        <p><span class="ticket-label">Total Amount:</span> ₹<?= htmlspecialchars($bookingDetails['total_amount']) ?></p>
        <p><span class="ticket-label">Status:</span> <span class="highlight"><?= htmlspecialchars($bookingDetails['status']) ?></span></p>
    </div>

    <div class="ticket-footer">
        <button onclick="window.print()" class="btn-print">🖨 Print Ticket</button>
        <p class="mt-3">Thank you for booking with <strong>Trekout</strong>! Have a safe journey. 🚍</p>
    </div>
</div>

</body>
</html>