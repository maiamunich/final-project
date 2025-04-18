<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artwork</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
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
                        <a class="nav-link" href="/artworks">Gallery</a>
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
                <button type="submit" class="btn btn-primary">Update Artwork</button>
                <a href="#" id="cancel-btn" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Get artwork ID from URL
            const artworkId = window.location.pathname.split('/').pop();
            
            // Fetch artwork data
            $.ajax({
                url: `/api/artworks/${artworkId}`,
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
                    
                    // Set cancel button href
                    $('#cancel-btn').attr('href', `/artworks/${artworkId}`);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching artwork:', error);
                    alert('Error loading artwork data. Please try again later.');
                }
            });

            // Handle form submission
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
                    url: `/api/artworks/${artworkId}/update`,
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        alert('Artwork updated successfully!');
                        window.location.href = `/artworks/${artworkId}`;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating artwork:', error);
                        alert('Error updating artwork. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html> 