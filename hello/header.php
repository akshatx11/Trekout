<?php
if (!isset($_SESSION)) { session_start(); }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trekout - Student Bus Travel in India</title>
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

 <header>
    <nav class="navbar">
        <a href="index.php" class="logo"><img src="logo3.jpeg" alt="Trekout Logo" style="width: 160px;"></a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="routes.php">Routes</a>
            <a href="eticket.php">E-Ticket</a>
            <a href="testimonials.php">Testimonials</a>
            <a href="contact.php">Contact</a>
            <a href="index.php#features">Why Us</a>
        </div>
        <div class="auth-buttons">
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] != "") { ?>
                <span style="margin-right:10px;">Welcome, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></span>
                <button class="signup-btn" onclick="window.location.href='logout.php'">Logout</button>
            <?php } else { ?>
                <button class="signup-btn" onclick="window.location.href='login.php'">Login</button>
                <button class="signup-btn" onclick="window.location.href='login.php?signup=1'">Sign Up</button>
            <?php } ?>
        </div>
        <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div> 
    </nav>
 </header>
</body>