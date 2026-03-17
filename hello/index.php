<?php
session_start();
// Main home page for Trekout
?>
<?php include 'header.php'; ?>

 
<style>
    

    /* Search Form */
    .search-container {
        background: white;
        border-radius: 12px;
        padding: 20px;
        max-width: 900px;
        margin: 40px auto;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .search-form {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
    }
    .form-group label {
        font-weight: bold;
        font-size: 0.9rem;
    }
    .form-group input, 
    .form-group select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 100%;
    }
    .search-btn {
        background: #ff6b00;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 1rem;
        transition: 0.3s;
    }
    .search-btn:hover {
        background: #e65c00;
    }

   

    
</style> 
    <main>
        <section class="hero">
            <h1 style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Every Journey Is Unique. So We Are.</h1>
            <p>Book affordable bus tickets for student travels across India's top destinations with Trekout.</p>

            <div class="search-container">
                <div class="search-tabs">
                    <div class="tab active">Bus Tickets</div>
                </div>

                <div class="search-form">
                    <div class="form-group">
                        <label for="from">From</label>
                        <input type="text" id="from" placeholder="Departure City" list="cities">
                    </div>
                    <div class="form-group">
                        <label for="to">To</label>
                        <input type="text" id="to" placeholder="Destination City" list="cities">
                    </div>
                    <div class="form-group">
                        <label for="date">Departure Date</label>
                        <input type="date" id="date">
                    </div>
                    <div class="form-group">
                        <label for="passengers">Passengers</label>
                        <select id="passengers">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6+</option>
                        </select>
                    </div>
                    <button class="search-btn" onclick="searchRoutes()">Search Buses</button>
                </div>

                <datalist id="cities">
                    <option value="Delhi">
                    <option value="Mumbai">
                    <option value="Bangalore">
                    <option value="Hyderabad">
                    <option value="Chennai">
                    <option value="Kolkata">
                    <option value="Pune">
                    <option value="Jaipur">
                    <option value="Ahmedabad">
                    <option value="Goa">
                </datalist>
            </div>
        </section>

        <section class="features" id="features">
            <h2 class="section-title">Why Choose Trekout</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🚌</div>
                    <h3 class="feature-title">Student-Friendly Fares</h3>
                    <p class="feature-desc">Special discounted rates verified by student ID cards to make travel affordable.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🎫</div>
                    <h3 class="feature-title">Instant E-Tickets</h3>
                    <p class="feature-desc">Get your tickets instantly on your phone with student verification QR codes.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3 class="feature-title">Verified Reviews</h3>
                    <p class="feature-desc">Real student reviews to help you choose the best buses for your journey.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🛌</div>
                    <h3 class="feature-title">Safe Sleeper Buses</h3>
                    <p class="feature-desc">Curated selection of buses with female-only sections and security features.</p>
                </div>
            </div>
        </section>

        <section class="testimonials" id="testimonials">
            <h2 class="section-title">What Students Say</h2>
            <div class="testimonial-slider">
                <div class="testimonial-card">
                    <div id="demo" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img1.png" alt="Los Angeles" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="img2.png" alt="Los Angeles" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="img3.png" alt="Chicago" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="img4.png" alt="New York" class="d-block w-100">
                            </div>
                        </div>

                        <button class="carousel-control-prev btn-warning" type="button" data-bs-target="#demo" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next btn-warning" type="button" data-bs-target="#demo" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>


<?php include 'footer.php'; ?>
