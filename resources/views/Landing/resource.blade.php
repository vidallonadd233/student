
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .resource-category {
            margin-bottom: 1.5rem;
        }
        .resource-item {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #f9f9f9;
            transition: box-shadow 0.3s;
        }
        .resource-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .featured-resource {
            background-color: #e9f5e9;
            border: 1px solid #d0f0d0;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        .search-bar {
            margin-bottom: 2rem;
        }
        .download-links a {
            display: block;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Your Platform</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Resources</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container py-5">
        <h1 class="text-center mb-4">Educational Resources</h1>

        <!-- Search Bar -->
        <div class="search-bar text-center mb-4">
            <input type="text" class="form-control w-75 mx-auto" placeholder="Search resources...">
        </div>

        <!-- Featured Resources -->
        <div class="featured-resource">
            <h2>Featured Resources</h2>
            <p>Check out our most important and recent resources to help you stay informed.</p>
            <!-- Example featured resource -->
            <div class="resource-item">
                <h4>Understanding Bullying</h4>
                <p>A comprehensive guide on recognizing and understanding various forms of bullying.</p>
                <a href="#" class="btn btn-primary">Read More</a>
            </div>
        </div>

        <!-- Resource Categories -->
        <div class="row">
            <!-- Articles -->
            <div class="col-md-6 resource-category">
                <h3>Articles</h3>
                <div class="resource-item">
                    <h4>Article Title 1</h4>
                    <p>Brief description of the article.</p>
                    <a href="#" class="btn btn-secondary">Read More</a>
                </div>
                <!-- More articles -->
            </div>

            <!-- Videos -->
            <div class="col-md-6 resource-category">
                <h3>Videos</h3>
                <div class="resource-item">
                    <h4>Video Title 1</h4>
                    <p>Brief description of the video.</p>
                    <a href="#" class="btn btn-secondary">Watch Video</a>
                </div>
                <!-- More videos -->
            </div>
        </div>

        <!-- Helplines and Guides -->
        <div class="row">
            <!-- Helplines -->
            <div class="col-md-6 resource-category">
                <h3>Helplines</h3>
                <div class="resource-item">
                    <h4>Helpline Title 1</h4>
                    <p>Contact information for immediate support.</p>
                    <a href="#" class="btn btn-secondary">Call Now</a>
                </div>
                <!-- More helplines -->
            </div>

            <!-- Guides -->
            <div class="col-md-6 resource-category">
                <h3>Guides</h3>
                <div class="resource-item">
                    <h4>Guide Title 1</h4>
                    <p>Downloadable guides for detailed information.</p>
                    <a href="#" class="btn btn-secondary">Download Guide</a>
                </div>
                <!-- More guides -->
            </div>
        </div>

        <!-- Download Links -->
        <div class="download-links mt-5">
            <h3>Downloadable Materials</h3>
            <a href="download/resource1.pdf" class="btn btn-info">Download Resource 1</a>
            <a href="download/resource2.pdf" class="btn btn-info">Download Resource 2</a>
            <!-- More download links -->
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
