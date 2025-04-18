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
                    <a href="#" class="btn btn-outline-secondary me-2 mb-2 active" data-class="All">All</a>
                </div>
            </div>
        </div>

        <!-- Artworks Grid -->
        <div class="artworks-grid" id="artworks-container"></div>
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
                    console.log('Received data:', data); // Debug log
                    
                    // Render class buttons
                    const classButtonsContainer = $('#class-buttons-container');
                    if (data.classes && data.classes.length > 0) {
                        data.classes.forEach(function(className) {
                            if (className) { // Only add non-empty class names
                                const button = $(`
                                    <a href="#" 
                                       class="btn btn-outline-secondary me-2 mb-2"
                                       data-class="${className}">
                                        ${className}
                                    </a>
                                `);
                                classButtonsContainer.append(button);
                            }
                        });
                    }

                    // Render artworks
                    const artworksContainer = $('#artworks-container');
                    if (data.artworks && data.artworks.length > 0) {
                        data.artworks.forEach(function(artwork) {
                            console.log('Rendering artwork:', artwork); // Debug log
                            const artworkCard = $(`
                                <div class="artwork-card" data-class="${artwork.class_name || ''}">
                                    <div class="artwork-image">
                                        <img src="${artwork.image_url}" 
                                             alt="${artwork.title}">
                                    </div>
                                    <div class="artwork-info">
                                        <h3>${artwork.title}</h3>
                                        ${artwork.class_name ? 
                                            `<p class="class-tag">${artwork.class_name}</p>` : 
                                            ''}
                                        <p>${artwork.description || ''}</p>
                                        <p>
                                            <small>
                                                Medium: ${artwork.medium || 'Not specified'}<br>
                                                Dimensions: ${artwork.dimensions || 'Not specified'}
                                            </small>
                                        </p>
                                        ${artwork.price ? 
                                            `<p><strong>Price: $${parseFloat(artwork.price).toFixed(2)}</strong></p>` : 
                                            ''}
                                        <div class="artwork-actions">
                                            <a href="/artworks/${artwork.id}" class="btn">View Details</a>
                                            ${artwork.etsy_url ? 
                                                `<a href="${artwork.etsy_url}" 
                                                   class="btn ms-2 etsy-link" 
                                                   target="_blank">Buy on Etsy</a>` : 
                                                ''}
                                        </div>
                                    </div>
                                </div>
                            `);
                            artworksContainer.append(artworkCard);
                        });
                    } else {
                        artworksContainer.html('<div class="alert alert-info">No artworks found.</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching artworks:', error, xhr.responseText);
                    $('#artworks-container').html('<div class="alert alert-danger">Error loading artworks. Please try again later.</div>');
                }
            });
        });
    </script>
</body>
</html> 