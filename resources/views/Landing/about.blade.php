@include('landing.layout')
    @include('landing.letter')



@include('layout.navbar')

<div class="container mt-5">
    <!-- About Us Section Header -->
    <section id="what-is-bullying" class="mb-5">
        <h3 class="text-dark">What is Bullying?</h3>
        <p class="text-justify text-muted">
            Bullying is a deliberate and hurtful behavior that involves an imbalance of power. It can happen in many forms,
            such as physical, verbal, or online, and often targets individuals or groups who are vulnerable or perceived as
            different. Bullying can cause emotional, psychological, and even physical harm to the victim, affecting their well-being.
        </p>
    </section>

    <!-- Types of Bullying -->
    <section id="types-of-bullying" class="mb-5">
        <h3 class="text-dark">Types of Bullying</h3>
        <p class="text-justify text-muted">
            Bullying can take on various forms. Below are the most common types:
        </p>
        <div class="row">
            <!-- Physical Bullying -->
            <div class="mb-4 col-md-4">
                <div class="shadow-lg card h-100">
                    <img src="image/physical.jpeg" class="card-img-top img-fluid" alt="Physical Bullying">
                    <div class="card-body">
                        <h5 class="card-title">Physical Bullying</h5>
                        <p class="text-justify card-text">This includes hitting, pushing, or any other physical harm meant to intimidate or hurt the victim.</p>
                    </div>
                </div>
            </div>
            <!-- Verbal Bullying -->
            <div class="mb-4 col-md-4">
                <div class="shadow-lg card h-100">
                    <img src="image/verbal.jpeg" class="card-img-top img-fluid" alt="Verbal Bullying">
                    <div class="card-body">
                        <h5 class="card-title">Verbal Bullying</h5>
                        <p class="text-justify card-text">This includes name-calling, teasing, or making hurtful comments to belittle someone.</p>
                    </div>
                </div>
            </div>
            <!-- Cyberbullying -->
            <div class="mb-4 col-md-4">
                <div class="shadow-lg card h-100">
                    <img src="image/cyberbullying.jpeg" class="card-img-top img-fluid" alt="Cyberbullying">
                    <div class="card-body">
                        <h5 class="card-title">Cyberbullying</h5>
                        <p class="text-justify card-text">Bullying through social media, text messages, or other online platforms to spread harmful content.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact of Bullying -->
    <section id="impact-of-bullying" class="mb-5">
        <h3 class="text-dark">Impact of Bullying</h3>
        <p class="text-justify text-muted">
            Bullying can have severe long-term consequences on individuals. Victims may experience:
        </p>
        <ul class="text-muted">
            <li>Increased feelings of depression and anxiety.</li>
            <li>Lower self-esteem and confidence.</li>
            <li>Academic difficulties and absenteeism from school.</li>
            <li>Potential for self-harm or even suicidal thoughts in extreme cases.</li>
        </ul>
        <p class="text-justify text-muted">
            It is crucial to address bullying promptly and create a supportive environment to prevent these effects.
        </p>
    </section>

    <!-- Why This Platform Matters -->
    <section id="why-this-platform" class="mb-5">
        <h3 class="text-dark">Why This Platform Matters</h3>
        <p class="text-justify text-muted">
            Our Anti-Bullying Incident Reporting and Monitoring Platform was created to provide a safe space for students,
            staff, and school authorities to report, track, and manage bullying incidents. By using this platform:
        </p>
        <ul class="text-muted">
            <li>We can ensure that incidents are addressed in a timely manner.</li>
            <li>We provide support for victims of bullying.</li>
            <li>We promote a safe and respectful school environment for everyone.</li>
        </ul>
        <p class="text-justify text-muted">
            Through this platform, we aim to eradicate bullying and foster a culture of kindness, respect, and empathy within the school community.
        </p>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggler = document.getElementById("navbarToggler");
        const navbar = document.getElementById("navbarNavDropdown");

        // Toggle open and close for mobile view
        toggler.addEventListener("click", function () {
            const isExpanded = navbar.classList.contains("show");

            // Add or remove the Bootstrap "show" class
            if (isExpanded) {
                navbar.classList.remove("show");
                toggler.setAttribute("aria-expanded", "false");
            } else {
                navbar.classList.add("show");
                toggler.setAttribute("aria-expanded", "true");
            }
        });
    });
</script>

<footer class="py-4 text-white bg-success">
    <div class="container">
        <div class="row">
            <!-- Contact Us Section (Left Column) -->
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <div class="text-justify" style="font-size: 1rem;">
                    <p>
                        <i class="bi bi-envelope-fill fs-6"></i>
                        <span>Email:</span>
                        <a href="mailto:paliparan3shs@gmail.com" class="text-white"> paliparan3shs@gmail.com</a>
                    </p>
                    <p>
                        <i class="bi bi-envelope-fill fs-6"></i>
                        <span>DepEd Email:</span>
                        <a href="mailto:342298@deped.gov.ph" class="text-white"> 342298@deped.gov.ph</a>
                    </p>
                    <p>
                        <i class="bi bi-telephone-fill fs-6"></i>
                        <span>Phone:</span>
                        <a href="tel:+63464505982" class="text-white"> (046) 450-5982</a>
                    </p>
                    <p>
                        <i class="bi bi-geo-alt-fill fs-6"></i>
                        <span>Address:</span>
                        Block 194, Phase V, Paliparan III, City of Dasmariñas, Cavite
                    </p>
                </div>
            </div>

            <!-- Follow Us Section (Middle Column) -->
            <div class="col-md-4 mb-4 text-center">
                <h5>Follow Us</h5>
                <a href="https://www.facebook.com/DepEdTayoPAL3SHS342298" class="text-white fs-4" target="_blank" aria-label="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
            </div>

            <!-- Map Section (Right Column) -->
            <div class="col-md-4 mb-4">
                <h5 class="text-center fw-normal">Our Location</h5>
                <div id="map" style="height: 200px; width: 100%; border-radius: 8px; background-color: #ccc;"></div>
            </div>
        </div>

        <!-- Footer Bottom Section -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p class="mb-0 fw-light" style="font-size: 1rem;">
                    © 2024 Paliparan III SHS Platform. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
* Enhanced styles for map container */
.map-container {
    font-family: 'Times New Roman', Times, serif;
    margin-left: 20px;

}

.card {
    border: none;
    border-radius: 10px; /* Smoothened corners for a more modern look */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added subtle shadow */
}

/* Map dimensions and appearance */
#map {
    height: 400px;
    width: 200%;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Adding shadow for map */
}
<style>

.text-center {
    font-weight: 600;
    text-transform: uppercase; /* Emphasize header */
}

/* Added responsiveness */
@media (max-width: 768px) {
    #map {
        height: 300px; /* Reduce map size on smaller screens */
    }
}

</style>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Initialize map centered on a fixed location (Paliparan 3 Senior High School)
    var map = L.map('map').setView([14.3500, 120.9500], 15);

    // Custom icon for the marker
    var customIcon = L.divIcon({
        className: 'custom-icon',
        html: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="green" viewBox="0 0 16 16">
                <path d="M8 0c-.69 0-1.341.032-1.986.09-1.304.12-2.682.36-4.057.684C1.134.91.508 1.327.234 1.513A.625.625 0 0 0 0 2.094C0 5.945 1.595 9.905 4.503 12.96 6.495 15.011 8 16 8 16s1.505-.989 3.497-3.04C14.405 9.905 16 5.945 16 2.094a.625.625 0 0 0-.234-.581c-.274-.186-.9-.603-1.722-.74a46.257 46.257 0 0 0-4.057-.684A28.513 28.513 0 0 0 8 0zm3.354 5.146a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7 8.793l3.646-3.647a.5.5 0 0 1 .708 0z"/>
                </svg>`,
        iconSize: [38, 38],
        iconAnchor: [19, 38],
        popupAnchor: [-3, -38]
    });

    // Add OpenStreetMap layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: ''
    }).addTo(map);

    // Add marker with custom icon and popup info
    L.marker([14.3500, 120.9500], { icon: customIcon }).addTo(map)
        .bindPopup('Paliparan 3 Senior High School')
        .openPopup();
</script>
