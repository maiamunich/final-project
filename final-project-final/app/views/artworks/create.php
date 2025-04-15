<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Artwork</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
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
        <h1>Add New Artwork</h1>
        <a href="/artworks" class="btn btn-secondary mb-4">Back to Gallery</a>
        
        <form method="POST" action="/artworks/create" class="mt-4">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" id="year" name="year" required>
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
                <button type="submit" class="btn btn-primary">Add Artwork</button>
            </div>
        </form>
    </div>

    <footer class="mt-5 py-3 bg-light">
        <div class="container text-center">
            <p>&copy; <?= date('Y') ?> Art Portfolio. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 