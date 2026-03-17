<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

// Enable detailed error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Logging function
function logError($message, $data = []) {
    $logFile = 'booking_errors.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] $message";
    if (!empty($data)) {
        $logEntry .= " | Data: " . json_encode($data);
    }
    $logEntry .= "\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    $error = 'User not logged in - session id missing';
    logError($error, ['session' => $_SESSION]);
    echo json_encode(['success' => false, 'error' => $error]);
    exit();
}

// Required fields
$required_fields = [
    'passenger_name', 'passenger_age', 'passenger_gender',
    'passenger_email', 'passenger_phone', 'student_id',
    'route_name', 'operator', 'departure_date', 'departure_time',
    'seats', 'total_amount'
];

$missing_fields = [];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || $_POST[$field] === '') {
        $missing_fields[] = $field;
    }
}

if (!empty($missing_fields)) {
    $error = "Missing required fields: " . implode(', ', $missing_fields);
    logError($error, $_POST);
    echo json_encode(['success' => false, 'error' => $error]);
    exit();
}

// Generate unique booking ID
$booking_id = uniqid('BK');

// Handle nullable passenger_age
$passenger_age = $_POST['passenger_age'] !== '' ? $_POST['passenger_age'] : null;

// Prepare SQL
$sql = "INSERT INTO booking (
    user_id, student_id, passenger_name, passenger_age, passenger_gender, passenger_email, passenger_phone,
    booking_id, route_name, operator, departure_date, departure_time, seats, total_amount, status, created_at
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'confirmed', NOW())";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    $error = "Prepare failed: " . $conn->error;
    logError($error, $_POST);
    echo json_encode(['success' => false, 'error' => $error]);
    exit();
}

// Log all booking values for debugging
logError('Booking values', [
    'user_id' => $_SESSION['id'],
    'student_id' => $_POST['student_id'],
    'passenger_name' => $_POST['passenger_name'],
    'passenger_age' => $passenger_age,
    'passenger_gender' => $_POST['passenger_gender'],
    'passenger_email' => $_POST['passenger_email'],
    'passenger_phone' => $_POST['passenger_phone'],
    'booking_id' => $booking_id,
    'route_name' => $_POST['route_name'],
    'operator' => $_POST['operator'],
    'departure_date' => $_POST['departure_date'],
    'departure_time' => $_POST['departure_time'],
    'seats' => $_POST['seats'],
    'total_amount' => $_POST['total_amount']
]);

// Bind parameters (types corrected)
$stmt->bind_param(
    "iisisssssssssd",
    $_SESSION['id'],
    $_POST['student_id'],
    $_POST['passenger_name'],
    $passenger_age,
    $_POST['passenger_gender'],
    $_POST['passenger_email'],
    $_POST['passenger_phone'],
    $booking_id,
    $_POST['route_name'],
    $_POST['operator'],
    $_POST['departure_date'],
    $_POST['departure_time'],
    $_POST['seats'],
    $_POST['total_amount']
);

// Execute
if ($stmt->execute()) {
    $_SESSION['booking_id'] = $booking_id;
    echo json_encode([
        'success' => true,
        'booking_id' => $booking_id,
        'message' => 'Booking confirmed successfully!'
    ]);
} else {
    logError('Booking save error: ' . $stmt->error, $_POST);
    echo json_encode(['success' => false, 'error' => 'Failed to save booking: ' . $stmt->error]);
}
?>
