<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artwork Details</title>
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
        <a href="/artworks" class="btn btn-secondary mb-4">Back to Gallery</a>
        
        <div id="artwork-details">
            <div class="row">
                <div class="col-md-6">
                    <img id="artwork-image" src="" alt="" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h1 id="artwork-title"></h1>
                    <p id="artwork-class" class="class"></p>
                    <p id="artwork-medium" class="medium"></p>
                    <p id="artwork-dimensions"></p>
                    <p id="artwork-price"></p>
                    <div id="artwork-description" class="description mt-3">
                        <h3>Description</h3>
                        <p></p>
                    </div>
                    <div class="artwork-actions mt-4">
                        <a id="etsy-link" href="#" class="btn btn-success etsy-link" target="_blank" style="display: none;">View on Etsy</a>
                        <a id="edit-link" href="#" class="btn btn-primary">Edit Artwork</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Get artwork ID from URL
            const artworkId = window.location.pathname.split('/').pop();
            
            // Fetch artwork details
            $.ajax({
                url: `/api/artworks/${artworkId}`,
                type: 'GET',
                dataType: 'json',
                success: function(artwork) {
                    // Update page title
                    document.title = `${artwork.title} - Art Portfolio`;
                    
                    // Update image
                    $('#artwork-image').attr({
                        'src': artwork.image_url,
                        'alt': artwork.title
                    });
                    
                    // Update title
                    $('#artwork-title').text(artwork.title);
                    
                    // Update class if available
                    if (artwork.class_name) {
                        $('#artwork-class').text(`Class: ${artwork.class_name}`).show();
                    } else {
                        $('#artwork-class').hide();
                    }
                    
                    // Update medium
                    $('#artwork-medium').text(`Medium: ${artwork.medium || 'Not specified'}`);
                    
                    // Update dimensions if available
                    if (artwork.dimensions) {
                        $('#artwork-dimensions').text(`Dimensions: ${artwork.dimensions}`).show();
                    } else {
                        $('#artwork-dimensions').hide();
                    }
                    
                    // Update price if available
                    if (artwork.price) {
                        $('#artwork-price').text(`Price: $${parseFloat(artwork.price).toFixed(2)}`).show();
                    } else {
                        $('#artwork-price').hide();
                    }
                    
                    // Update description if available
                    if (artwork.description) {
                        $('#artwork-description p').text(artwork.description);
                        $('#artwork-description').show();
                    } else {
                        $('#artwork-description').hide();
                    }
                    
                    // Update Etsy link if available
                    if (artwork.etsy_url) {
                        $('#etsy-link').attr('href', artwork.etsy_url).show();
                    } else {
                        $('#etsy-link').hide();
                    }
                    
                    // Update edit link
                    $('#edit-link').attr('href', `/artworks/${artworkId}/edit`);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching artwork:', error);
                    $('#artwork-details').html(`
                        <div class="alert alert-danger">
                            Error loading artwork details. Please try again later.
                        </div>
                    `);
                }
            });
        });
    </script>
</body>
</html> 