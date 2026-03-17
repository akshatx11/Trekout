<?php
// Contact page for Trekout
?>
<?php include 'header.php'; ?>

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        position: relative;
        min-height: 100vh;
    }

    /* Background image styling */
    .background-image2 img {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1; /* Push behind content */
    }

    /* Overlay for better text readability */
    .overlay {
        background-color: rgba(255, 255, 255, 0.85);
        min-height: 100vh;
        padding-top: 50px;
        padding-bottom: 50px;
    }
</style>

<body>
    <div class="background">
        <div class="background-image2">
            <img src="bg.jpg" alt="background image">
        </div>
    </div>

    <div class="overlay">
        <main>
            <!-- Hero Section -->
            <section class="hero" style="padding: 100px 0 50px; text-align: center;">
                <h1 style="font-weight: 700; font-size: 2.5rem; margin-bottom: 10px;">
                    Contact Us
                </h1>
                <p style="font-size: 1.1rem; color: #333; max-width: 600px; margin: 0 auto;">
                    Have a question or need support? Our team is here to help you with everything related to student bus travel.
                </p>
            </section>

            <!-- Contact Section -->
            <section class="contact-section" style="padding: 50px 0;">
                <div class="contact-container" style="display: flex; flex-wrap: wrap; max-width: 1100px; margin: auto; gap: 30px;">

                    <!-- Contact Information -->
                    <div class="contact-info" style="flex: 1; min-width: 300px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <h2 style="margin-bottom: 15px; color: #222;">Get In Touch</h2>
                        <p style="color: #666; margin-bottom: 20px;">
                            We’d love to hear from you! Reach out using any of the details below.
                        </p>

                        <div class="contact-details">
                            <div class="contact-item" style="margin-bottom: 15px;">
                                <h3 style="margin-bottom: 5px;">📍 Address</h3>
                                <p style="color: #555;">SKIT Ramanagaria, Jagatpura<br>Rajasthan, India</p>
                            </div>
                            <div class="contact-item" style="margin-bottom: 15px;">
                                <h3 style="margin-bottom: 5px;">📞 Phone</h3>
                                <p style="color: #555;">+91 98765 43210</p>
                            </div>
                            <div class="contact-item">
                                <h3 style="margin-bottom: 5px;">✉️ Email</h3>
                                <p style="color: #555;">help@trekout.in</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form" style="flex: 1; min-width: 300px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <h2 style="margin-bottom: 20px; color: #222;">Send Us a Message</h2>
                        <form action="#" method="post" style="display: flex; flex-direction: column; gap: 15px;">

                            <div class="form-group">
                                <label for="name" style="font-weight: 500;">Full Name</label>
                                <input type="text" id="name" name="name" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                            </div>

                            <div class="form-group">
                                <label for="email" style="font-weight: 500;">Email</label>
                                <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                            </div>

                            <div class="form-group">
                                <label for="subject" style="font-weight: 500;">Subject</label>
                                <input type="text" id="subject" name="subject" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                            </div>

                            <div class="form-group">
                                <label for="message" style="font-weight: 500;">Message</label>
                                <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
                            </div>

                            <button type="submit" style="background: #007bff; color: #fff; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-weight: 500;">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>


</body>
<?php include 'footer.php'; ?>
