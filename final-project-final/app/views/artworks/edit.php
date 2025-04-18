<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artwork</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/styles/homepage.css" rel="stylesheet">
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
        <h1>Edit Artwork</h1>
        
        <form id="edit-artwork-form" class="mt-4">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="class_name" class="form-label">Class (if applicable)</label>
                <input type="text" class="form-control" id="class_name" name="class_name">
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label">Image URL</label>
                <input type="url" class="form-control" id="image_url" name="image_url" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="medium" class="form-label">Medium</label>
                <input type="text" class="form-control" id="medium" name="medium">
            </div>

            <div class="mb-3">
                <label for="dimensions" class="form-label">Dimensions</label>
                <input type="text" class="form-control" id="dimensions" name="dimensions">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price">
            </div>

            <div class="mb-3">
                <label for="etsy_url" class="form-label">Etsy URL (if available)</label>
                <input type="url" class="form-control" id="etsy_url" name="etsy_url">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn">Update Artwork</button>
                <a href="#" id="cancel-btn" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
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

            // Get artwork ID from URL (extracting from /artworks/edit/{id})
            const pathSegments = window.location.pathname.split('/');
            const artworkId = pathSegments[pathSegments.length - 1]; // Assuming ID is the last segment
            
            // Fetch artwork data to populate the form
            $.ajax({
                url: `/api/artworks/${artworkId}`, // Use the existing API endpoint
                type: 'GET',
                dataType: 'json',
                success: function(artwork) {
                    // Populate form fields
                    $('#title').val(artwork.title);
                    $('#class_name').val(artwork.class_name || '');
                    $('#image_url').val(artwork.image_url);
                    $('#description').val(artwork.description || '');
                    $('#medium').val(artwork.medium || '');
                    $('#dimensions').val(artwork.dimensions || '');
                    $('#price').val(artwork.price || '');
                    $('#etsy_url').val(artwork.etsy_url || '');
                    
                    // Set cancel button href to the artwork detail page
                    $('#cancel-btn').attr('href', `/artworks/${artworkId}`);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching artwork:', error);
                    alert('Error loading artwork data. Please try again later.');
                    // Redirect back or disable form
                    window.location.href = '/artworks'; 
                }
            });

            // Handle form submission via AJAX
            $('#edit-artwork-form').on('submit', function(e) {
                e.preventDefault();
                
                const formData = {
                    title: $('#title').val(),
                    class_name: $('#class_name').val(),
                    image_url: $('#image_url').val(),
                    description: $('#description').val(),
                    medium: $('#medium').val(),
                    dimensions: $('#dimensions').val(),
                    price: $('#price').val(),
                    etsy_url: $('#etsy_url').val()
                };

                $.ajax({
                    url: `/api/artworks/update/${artworkId}`, // We need to create this endpoint
                    type: 'POST', // Or PUT, but POST is simpler for forms
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        alert('Artwork updated successfully!');
                        window.location.href = `/artworks/${artworkId}`; // Redirect to detail view
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating artwork:', error, xhr.responseText);
                        alert('Error updating artwork. Please check console and try again.');
                    }
                });
            });
        });
    </script>
</body>
</html> 