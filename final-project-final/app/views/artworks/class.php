<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artworks by Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/gallery.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 id="class-title">Artworks by Class</h1>
        <a href="/artworks" class="btn btn-secondary mb-4">Back to Gallery</a>
        
        <div class="artworks-grid" id="artworks-container"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Get class name from URL
            const classPath = window.location.pathname.split('/');
            const className = decodeURIComponent(classPath[classPath.length - 1]);
            
            // Update page title
            document.title = `Artworks from ${className}`;
            $('#class-title').text(`Artworks from ${className}`);
            
            // Fetch artworks for this class
            $.ajax({
                url: `/api/artworks/class/${encodeURIComponent(className)}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const artworksContainer = $('#artworks-container');
                    
                    data.artworks.forEach(function(artwork) {
                        const artworkCard = $(`
                            <div class="artwork-card">
                                <div class="artwork-image">
                                    <img src="${artwork.image_url}" alt="${artwork.title}">
                                </div>
                                <div class="artwork-info">
                                    <h3>${artwork.title}</h3>
                                    <p class="medium">${artwork.medium || ''}</p>
                                    <div class="artwork-actions">
                                        <a href="/artworks/${artwork.id}" class="btn btn-primary">View Details</a>
                                        ${artwork.etsy_url ? 
                                            `<a href="${artwork.etsy_url}" class="btn btn-success etsy-link" target="_blank">View on Etsy</a>` : 
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
                    $('#artworks-container').html(`
                        <div class="alert alert-danger">
                            Error loading artworks. Please try again later.
                        </div>
                    `);
                }
            });
        });
    </script>
</body>
</html> 