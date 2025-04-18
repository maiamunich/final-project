<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/styles/homepage.css" rel="stylesheet">
    <link href="/assets/css/gallery.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/assets/js/gallery.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">Art Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/artworks">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Art Gallery</h1>

        <!-- Filter Buttons -->
        <div class="filter-section mb-4 medium-section">
            <div class="class-buttons mt-3">
                <h4>Filter by Class</h4>
                <div id="class-buttons-container">
                    <!-- Class buttons will be dynamically added here -->
                </div>
            </div>
        </div>

        <!-- Artworks Grid -->
        <div class="artworks-grid" id="artworks-container">
            <!-- Artworks will be dynamically added here -->
        </div>
    </div>

    <footer class="mt-5 py-3">
        <div class="container text-center">
            <p id="copyright"></p>
        </div>
    </footer>

    <script>
        // Set copyright year
        document.addEventListener('DOMContentLoaded', function() {
            const currentYear = new Date().getFullYear();
            document.getElementById('copyright').textContent = `© ${currentYear} Art Portfolio. All rights reserved.`;
        });
    </script>
</body>
</html> 