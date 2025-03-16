@include('landing.letter')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage </title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/map.css') }}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />




</head>
<body>

<script>
  // Force reinitialization if needed
document.querySelectorAll('.navbar-toggler').forEach(function(button) {
    button.addEventListener('click', function() {
        const navbar = document.querySelector(button.getAttribute('data-bs-target'));
        if (navbar.classList.contains('collapse')) {
            navbar.classList.remove('collapse');
        } else {
            navbar.classList.add('collapse');
        }
    });
});

</script>


<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


<script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            gsap.from(".carousel-item.active", { opacity: 0, y: 50, duration: 1 });
            gsap.from("#about-us", { opacity: 0, scale: 0.9, duration: 1.5, scrollTrigger: "#about-us" });
            gsap.from("#guidelines-tips h2", { opacity: 0, y: -50, duration: 1, delay: 0.5 });
        });
    </script>

</script>
</body>
</html>
