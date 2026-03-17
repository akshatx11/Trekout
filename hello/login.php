<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Trekout Student Bus Travel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style1.css">
    <script src="script1.js"></script>
</head>
<body>
    <div class="background">
        <div class="background-image"></div>
        <div class="background-overlay"></div>
    </div>

    <?php include 'header.php'; ?>

    <main class="login-main d-flex justify-content-center align-items-center" style="min-height:80vh;">
        <div class="login-container w-100" style="max-width:500px;">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <h2 class="text-center mb-2 fw-bold">Welcome Back</h2>
                    <p class="text-center text-muted mb-4">Login to your Trekout account</p>
                    
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $stmt = $conn->prepare("SELECT * FROM login WHERE email = ?");
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows === 1) {
                            $row = $result->fetch_assoc();
                            
                            // Verify password
                            if (password_verify($password, $row['password_hash'])) {
                                $_SESSION['username'] = $row['name'];
                                $_SESSION['id'] = $row['student_id'];
                            
                                // Fetch latest booking for this student
                                $studentId = $row['student_id'];
                                $bookingSql = "SELECT booking_id FROM booking WHERE student_id = ? ORDER BY created_at DESC LIMIT 1";
                                $bookingStmt = $conn->prepare($bookingSql);
                                $bookingStmt->bind_param("s", $studentId);
                                $bookingStmt->execute();
                                $bookingResult = $bookingStmt->get_result();
                            
                                if ($bookingRow = $bookingResult->fetch_assoc()) {
                                    $_SESSION['booking_id'] = $bookingRow['booking_id'];
                                    header("Location: eticket.php");
                                } else {
                                    header("Location: index.php");
                                }
                                exit();
                            } else {
                                echo '<div class="alert alert-danger">Incorrect password!</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">No account found with this email!</div>';
                        }
                    }
                    ?>

                    <form method="POST" class="login-form">
                        <input type="hidden" name="action" value="login">
                        <div class="mb-3">
                            <label for="login-email" class="form-label">Email Address</label>
                            <input type="email" id="login-email" name="email" class="form-control" required placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" id="login-password" name="password" class="form-control" required placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-3">Login</button>
                        <div class="text-center mt-3">
                            <small>Don't have an account? <a href="login.php?signup=1">Sign up here</a></small>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_GET['signup']) && $_GET['signup'] == 1) {
            ?>
            <div class="card shadow border-0 rounded-4 mt-4">
                <div class="card-body p-4">
                    <h2 class="text-center mb-2 fw-bold">Create New Account</h2>
                    <p class="text-center text-muted mb-4">Join Trekout for exclusive student travel deals</p>
                    
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'signup') {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $confirm = $_POST['confirm'];
                        $student_id = $_POST['student_id'];

                        if ($password !== $confirm) {
                            echo '<div class="alert alert-danger">Passwords do not match!</div>';
                        } else {
                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            $check = $conn->prepare("SELECT * FROM login WHERE email = ?");
                            $check->bind_param("s", $email);
                            $check->execute();
                            $result = $check->get_result();

                            if ($result->num_rows > 0) {
                                echo '<div class="alert alert-danger">Email already exists!</div>';
                            } else {
                                $stmt = $conn->prepare("INSERT INTO login (name, email, password_hash, student_id) VALUES (?, ?, ?, ?)");
                                $stmt->bind_param("ssss", $name, $email, $hash, $student_id);

                                if ($stmt->execute()) {
                                    echo "<script>alert('Signup successful! Please login.'); window.location.href = 'login.php';</script>";
                                } else {
                                    echo '<div class="alert alert-danger">Error creating account. Please try again.</div>';
                                }
                            }
                        }
                    }
                    ?>
                    
                    <form method="POST" class="signup-form">
                        <input type="hidden" name="action" value="signup">
                        <div class="mb-3">
                            <label for="signup-name" class="form-label">Full Name</label>
                            <input type="text" id="signup-name" name="name" class="form-control" required placeholder="Enter your full name">
                        </div>
                        <div class="mb-3">
                            <label for="signup-email" class="form-label">Email Address</label>
                            <input type="email" id="signup-email" name="email" class="form-control" required placeholder="Enter your email address">
                        </div>
                        <div class="mb-3">
                            <label for="signup-password" class="form-label">Password</label>
                            <input type="password" id="signup-password" name="password" class="form-control" required placeholder="Create a strong password">
                        </div>
                        <div class="mb-3">
                            <label for="signup-confirm" class="form-label">Confirm Password</label>
                            <input type="password" id="signup-confirm" name="confirm" class="form-control" required placeholder="Confirm your password">
                        </div>
                        <div class="mb-3">
                            <label for="student-id" class="form-label">Student ID Number</label>
                            <input type="text" id="student-id" name="student_id" class="form-control" required placeholder="Enter your student ID">
                        </div>
                        <button type="submit" class="btn btn-success w-100 rounded-3">Create Account</button>
                        <div class="text-center mt-3">
                            <small>Already have an account? <a href="login.php">Login here</a></small>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
