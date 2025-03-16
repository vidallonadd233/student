	@include('landing.layout')
@include('landing.letter')
<style>
    /* Enhanced styles for map container */
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

<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Map Section -->
        <div class="col-lg-6">
            <div class="card shadow">
              
                <div class="card-body">
                    <!-- Map Container -->
                    <div id="map" style="height: 400px; width: 100%; border-radius: 8px; overflow: hidden;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


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
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add marker with custom icon and popup info
    L.marker([14.3500, 120.9500], { icon: customIcon }).addTo(map)
        .bindPopup('Paliparan 3 Senior High School')
        .openPopup();
</script>
