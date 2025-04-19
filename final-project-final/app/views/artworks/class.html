<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artworks by Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/styles/homepage.css" rel="stylesheet">
    <link href="/assets/css/gallery.css" rel="stylesheet">
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
        <h1 id="class-title">Artworks by Class</h1>
        <a href="/artworks" class="btn btn-secondary mb-4">Back to Gallery</a>
        
        <div class="row g-4" id="artworks-container">
            <!-- Artworks will be loaded here by AJAX -->
        </div>
    </div>

    <footer class="mt-5 py-3">
        <div class="container text-center">
            <p id="copyright"></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Set copyright year
            const currentYear = new Date().getFullYear();
            $('#copyright').text(`© ${currentYear} Art Portfolio. All rights reserved.`);

            // Get class name from URL (extracting from /artworks/class/{className})
            const pathSegments = window.location.pathname.split('/');
            const className = decodeURIComponent(pathSegments[pathSegments.length - 1]); // Assuming class name is the last segment
            
            // Update page title
            document.title = `Artworks from ${className}`;
            $('#class-title').text(`Artworks from ${className}`);
            
            // Fetch artworks for this class via API
            $.ajax({
                url: `/api/artworks/class/${encodeURIComponent(className)}`, // We need to create this endpoint
                type: 'GET',
                dataType: 'json',
                success: function(artworks) {
                    const artworksContainer = $('#artworks-container');
                    artworksContainer.empty(); // Clear any previous content

                    if (!artworks || artworks.length === 0) {
                        artworksContainer.html('<div class="col-12"><div class="alert alert-info">No artworks found for this class.</div></div>');
                        return;
                    }
                    
                    artworks.forEach(function(artwork) {
                        const artworkId = artwork.id;
                        const imageUrl = artwork.image_url;
                        const artworkTitle = artwork.title;
                        const etsyUrl = artwork.etsy_url || '';

                        const artworkCard = $(`
                            <div class="col-md-6 col-lg-4">
                                <div class="card medium-section h-100">
                                    <img src="${imageUrl}" class="card-img-top" alt="${artworkTitle}">
                                    <div class="card-body">
                                        <h5 class="card-title">${artworkTitle}</h5>
                                        <!-- Add other details if needed -->
                                    </div>
                                    <div class="card-footer">
                                        <a href="/artworks/${artworkId}" class="btn">View Details</a>
                                        ${etsyUrl ? 
                                            `<a href="${etsyUrl}" class="btn ms-2" target="_blank">Buy on Etsy</a>` : 
                                            ''}
                                    </div>
                                </div>
                            </div>
                        `);
                        artworksContainer.append(artworkCard);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching artworks by class:', error, xhr.responseText);
                    $('#artworks-container').html('<div class="col-12"><div class="alert alert-danger">Error loading artworks. Please try again later.</div></div>');
                }
            });
        });
    </script>
</body>
</html> 