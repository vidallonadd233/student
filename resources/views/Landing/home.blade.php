@include('landing.layout')
    @include('landing.letter')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@include('layout.navbar')

    <main>
        <!-- Carousel -->
        <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <!-- Carousel Item 1: Welcome -->
                <div class="carousel-item active position-relative">
    <img src="image/picture5.jpg" class="w-100 h-100" alt="PAL3SHS Welcome" style="object-fit: cover;">
    <div class="top-0 position-absolute start-0 w-100 h-100" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7));"></div>
    <div class="container text-center text-white position-absolute top-50 start-50 translate-middle">
        <h1 class="mb-3" style="font-size: 2rem; font-weight: normal;">Welcome to PAL3SHS</h1>
        <p class="text-center fw-normal" style="text-transform: none; font-size: 1.2rem; line-height: 1.5;">
            Our platform ensures a supportive environment for
            all students at <br>Paliparan 3 Senior High School
            offering tools for safety, well-being, and academic excellence.
        </p>
        <a href="{{ route('about') }}" class="mt-3 btn btn-success" style="font-size: 1rem; font-weight: normal; border-radius: 30px;">
            Learn More
        </a>
    </div>
</div>

<div class="carousel-item position-relative w-100">
    <video class="w-100 h-100" autoplay loop muted playsinline>
        <source src="image/awareness .mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

</div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </main>

    <section id="about-us" class="mt-5 fw-normal">
    <div class="container">
        <div class="row">
            <!-- Left Column: Card with Text -->
            <div class="mb-4 col-md-6">
                <div class="shadow-lg card">
                    <div class="card-body">
                        <p class="mb-4 text-justify lead fw-normal" style="font-size: 1rem;">
                            We are dedicated to creating a safer environment for students by providing tools to report, monitor, and analyze bullying incidents. Our platform empowers educators, parents, and students to work together towards a safer community.
                        </p>
                        <p class="text-justify lead fw-normal" style="font-size: 1rem;">
                            Embodied in its Rhetoric “Lipad Paliparan 3 SHS” is the school’s vision for its graduates to become functionally literate twenty-first-century learners, prepared for college, and equipped with skills for various industries through National Certifications by TESDA.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Card with Image -->
            <div class="mb-4 col-md-6">
                <div class="shadow-lg card">
                    <img src="{{ asset('image/picture1.jpeg') }}" alt="About Us Image" class="rounded card-img-top">
                </div>
            </div>
        </div>

        <div class="mt-4 row">
            <!-- Second Column: Card with Image -->
            <div class="mb-4 col-md-6">
                <div class="shadow-lg card">
                    <img src="{{ asset('image/picture1.jpeg') }}" alt="About Us Image" class="rounded card-img-top">
                </div>
            </div>

            <!-- Third Column: Card with Text -->
            <div class="mb-4 col-md-6">
                <div class="shadow-lg card">
                    <div class="card-body">
                        <p class="mb-3 text-justify lead fw-normal" style="font-size: 1rem;">
                            Paliparan III Senior High School is committed to providing a holistic education that instills excellence, integrity, and service. We aim to develop academic and vocational skills while promoting values of love for God and country. Our goal is to offer a well-rounded education and prepare students for success in both local and global contexts.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 text-white bg-success">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Section Title -->
            <div class="mb-4 text-center col-12">
                <h2 class="text-white fw-lighter" style="font-size: 1.9rem;">Learn About Bullying</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Video Content Column -->
            <div class="mb-4 col-md-6">
                <div class="rounded shadow position-relative video-container">
                    <video class="rounded w-100" style="max-height: 300px; object-fit: cover;" controls>
                        <source src="{{ asset('image/What is Bullying.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag. Please <a href="{{ asset('storage/What is Bullying.mp4') }}" download>download the video</a>.
                    </video>
                </div>
            </div>

            <!-- Call to Action Column -->
            <div class="mb-4 col-md-6 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <p class="text-white lead">
                        Together, we can create a safe and supportive environment where everyone feels valued and respected.
                    </p>
                    <p class="text-white text-secondar fw-normal">
                        Speak up, stand together, and stop bullying
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="guidelines-tips" class="py-5">
    <div class="container">
        <!-- Section Title -->
        <div class="mb-4 text-center">
            <h2 class="fw-normal">Guidelines and Tips on Bullying</h2>
            <p class="text-muted">Learn how to prevent bullying and create a safe environment for everyone.</p>
        </div>

        <!-- Content Row -->
        <div class="row align-items-center">
            <!-- Video Section -->
            <div class="mb-4 col-lg-6 d-flex justify-content-center">
                <div class="shadow-sm ratio ratio-16x9 w-100">
                    <video controls class="w-100 h-100">
                        <source src="{{ asset('image/Tips.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="col-lg-6 d-flex flex-column">
                <h4 class="mb-3 fw-normal">Tips to Prevent Bullying</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3"></i>
                        <span>Encourage open communication with friends, teachers, and family.</span>
                    </li>
                    <li class="list-group-item d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3"></i>
                        <span>Foster a culture of respect and inclusivity in your school and community.</span>
                    </li>
                    <li class="list-group-item d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3"></i>
                        <span>Stand up for others by safely intervening or reporting bullying incidents.</span>
                    </li>
                    <li class="list-group-item d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3"></i>
                        <span>Stay informed by participating in awareness campaigns and workshops.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

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
