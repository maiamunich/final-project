<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($artwork['title']) ?> - Art Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/gallery.css" rel="stylesheet">
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
        
        <div class="row">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($artwork['image_url']) ?>" 
                     alt="<?= htmlspecialchars($artwork['title']) ?>" 
                     class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h1><?= htmlspecialchars($artwork['title']) ?></h1>
                <p class="year"><?= htmlspecialchars($artwork['year']) ?></p>
                
                <?php if (!empty($artwork['class_name'])): ?>
                    <p class="class">Class: <?= htmlspecialchars($artwork['class_name']) ?></p>
                <?php endif; ?>
                
                <p class="medium">Medium: <?= htmlspecialchars($artwork['medium']) ?></p>
                
                <?php if (!empty($artwork['dimensions'])): ?>
                    <p>Dimensions: <?= htmlspecialchars($artwork['dimensions']) ?></p>
                <?php endif; ?>
                
                <?php if (!empty($artwork['price'])): ?>
                    <p>Price: $<?= number_format($artwork['price'], 2) ?></p>
                <?php endif; ?>
                
                <?php if (!empty($artwork['description'])): ?>
                    <div class="description mt-3">
                        <h3>Description</h3>
                        <p><?= htmlspecialchars($artwork['description']) ?></p>
                    </div>
                <?php endif; ?>
                
                <div class="artwork-actions mt-4">
                    <?php if (!empty($artwork['etsy_url'])): ?>
                        <a href="<?= htmlspecialchars($artwork['etsy_url']) ?>" 
                           class="btn btn-success etsy-link" 
                           target="_blank">View on Etsy</a>
                    <?php endif; ?>
                    <a href="/artworks/<?= $artwork['id'] ?>/edit" class="btn btn-primary">Edit Artwork</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 py-3 bg-light">
        <div class="container text-center">
            <p>&copy; <?= date('Y') ?> Art Portfolio. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 