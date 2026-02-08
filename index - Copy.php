<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include "navbar.php"; ?>
<!-- HERO -->
<section class="hero">
    <div >
        <h1>All Professional Services in One Place</h1>
        <p>
            From home repairs to beauty care, vehicle maintenance, and IT solutions —
            book certified experts quickly, safely, and at affordable prices.
        </p>

        <div class="hero-actions">
            <a href="services.php" class="btn btn-primary">Book a Service</a>
            <a href="#how-it-works" class="btn btn-outline">How It Works</a>
        </div>
    </div>
</section>

<section id="services" class="boxr">
    <h2 style="text-align:center; margin-bottom:30px;">Popular Services</h2>

    <div class="about-cards">
        <div class="about-card">
            <h3>🔧 Home Maintenance</h3>
            <p>Plumbing, electrical, carpentry & appliance repair.</p>
        </div>

        <div class="about-card">
            <h3>🚗 Vehicle Services</h3>
            <p>Car wash, engine repair, oil change & diagnostics.</p>
        </div>

        <div class="about-card">
            <h3>💻 IT Solutions</h3>
            <p>Laptop repair, network setup, CCTV & software support.</p>
        </div>
    </div>

<section class="info-section ">
    <div class="info-text">
        <h2>Complete Professional Service Solutions</h2>
        <p>
            ServiceBooking is your one-stop platform designed to simplify your everyday service needs.
            Whether you need urgent home repairs, beauty services, IT troubleshooting, or vehicle
            maintenance — our platform connects you with verified professionals instantly.
        </p>
        <p>
            We focus on reliability, transparency, and quality. Each service provider goes through
            background verification and skill assessment to ensure your work is done safely and efficiently.
        </p>
        <p>
            No more searching through multiple vendors. Book services, track status, and manage
            appointments from one easy platform.
        </p>
    </div>
    <div class="info-img">
        <img src="1.jpg">
    </div>
</section>

<section class="info-section ">
    <div class="info-text">
        <h2>Home Maintenance & Repair Services</h2>
        <p>
            Our home services include plumbing, electrical work, carpentry, appliance repairs,
            painting, and general maintenance. Whether it's a leaking pipe or a faulty appliance,
            skilled technicians are ready to solve your issues.
        </p>
        <p>
            We ensure professionals arrive on time with the proper tools and expertise,
            minimizing disruption and delivering high-quality results.
        </p>
    </div>
    <div class="info-img">
        <img src="cs2.jpg">
    </div>
</section>

<section class="info-section ">
    <div class="info-text">
        <h2>Beauty & Personal Care at Home</h2>
        <p>
            Enjoy professional salon and spa services without leaving your home. From haircuts
            and facials to bridal makeup and grooming — experienced beauticians deliver comfort and luxury.
        </p>
        <p>
            We use high-quality products and maintain strict hygiene standards to ensure
            a safe and relaxing experience.
        </p>
    </div>
    <div class="info-img">
        <img src="bt.jpg">
    </div>
</section>
<section class="info-section ">
    <div class="info-text">
        <h2>IT, Tech Support & Smart Solutions</h2>
        <p>
            Facing issues with your computer, laptop, CCTV, or network? Our certified IT experts
            provide fast troubleshooting, installation, and repair services.
        </p>
        <p>
            From home Wi-Fi setup to office networking and security systems, we ensure
            seamless digital experiences.
        </p>
    </div>
    <div class="info-img">
        <img src="it.jpg">
    </div>
</section>
<section class="info-section " id="how-it-works">
    <div class="info-text">
        <h2>How ServiceBooking Works</h2>
        <p><b>Step 1:</b> Browse services and choose what you need.</p>
        <p><b>Step 2:</b> Select date and time that suits your schedule.</p>
        <p><b>Step 3:</b> A verified professional arrives and completes the job.</p>
        <p><b>Step 4:</b> Pay securely and leave feedback.</p>
        <p>
            Our process is designed to be smooth, transparent, and customer-friendly.
        </p>
    </div>
    <div class="info-img">
        <img src="st.jpg">
    </div>
</section>
<section class="info-section ">
    <div class="info-text">
        <h2>Why Thousands Trust ServiceBooking</h2>
        <p>✔ Verified & skilled professionals</p>
        <p>✔ Transparent pricing</p>
        <p>✔ Secure booking system</p>
        <p>✔ Fast service response</p>
        <p>✔ Customer satisfaction guarantee</p>
    </div>
    <div class="info-img">
        <img src="trust.jpg">
    </div>
</section>
<?php include "footer.php"; ?>
</body>
</html>
