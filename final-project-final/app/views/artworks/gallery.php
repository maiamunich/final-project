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
                <div id="class-buttons-container"></div>
            </div>
        </div>

        <!-- Artworks Grid -->
        <div class="row g-4" id="artworks-container"></div>
    </div>

    <footer class="mt-5 py-3">
        <div class="container text-center">
            <p id="copyright"></p>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            // Set copyright year
            const currentYear = new Date().getFullYear();
            $('#copyright').text(`© ${currentYear} Art Portfolio. All rights reserved.`);

            // Fetch artworks and classes
            $.ajax({
                url: '/api/artworks',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Render class buttons
                    const classButtonsContainer = $('#class-buttons-container');
                    data.classes.forEach(function(className) {
                        const button = $(`
                            <a href="/artworks/class/${encodeURIComponent(className)}" 
                               class="btn btn-outline-secondary me-2 mb-2">
                                ${className}
                            </a>
                        `);
                        classButtonsContainer.append(button);
                    });

                    // Render artworks
                    const artworksContainer = $('#artworks-container');
                    data.artworks.forEach(function(artwork) {
                        const artworkCard = $(`
                            <div class="col-md-6 col-lg-4">
                                <div class="card medium-section h-100">
                                    <img src="${artwork.image_url}" 
                                         class="card-img-top" 
                                         alt="${artwork.title}">
                                    <div class="card-body">
                                        <h5 class="card-title">${artwork.title}</h5>
                                        <p class="card-text">
                                            ${artwork.class_name ? 
                                                `<span class="badge bg-secondary">${artwork.class_name}</span>` : 
                                                ''}
                                        </p>
                                        <p class="card-text">${artwork.description || ''}</p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                Medium: ${artwork.medium || 'Not specified'}<br>
                                                Dimensions: ${artwork.dimensions || 'Not specified'}
                                            </small>
                                        </p>
                                        ${artwork.price ? 
                                            `<p class="card-text">
                                                <strong>Price: $${parseFloat(artwork.price).toFixed(2)}</strong>
                                            </p>` : 
                                            ''}
                                    </div>
                                    <div class="card-footer">
                                        <a href="/artworks/${artwork.id}" class="btn">View Details</a>
                                        ${artwork.etsy_url ? 
                                            `<a href="${artwork.etsy_url}" 
                                               class="btn ms-2" 
                                               target="_blank">Buy on Etsy</a>` : 
                                            ''}
                                    </div>
                                </div>
                            </div>
                        `);
                        artworksContainer.append(artworkCard);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching artworks:', error);
                    $('#artworks-container').html('<div class="alert alert-danger">Error loading artworks. Please try again later.</div>');
                }
            });
        });
    </script>
</body>
</html> 