<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artworks from <?= $class ?></title>
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
        <h1>Artworks from <?= $class ?></h1>
        <a href="/artworks" class="btn btn-secondary mb-4">Back to Gallery</a>
        
        <div class="artworks-grid">
            <?php foreach ($artworks as $artwork): ?>
                <div class="artwork-card">
                    <div class="artwork-image">
                        <img src="<?= htmlspecialchars($artwork['image_url']) ?>" alt="<?= htmlspecialchars($artwork['title']) ?>">
                    </div>
                    <div class="artwork-info">
                        <h3><?= htmlspecialchars($artwork['title']) ?></h3>
                        <p class="year"><?= htmlspecialchars($artwork['year']) ?></p>
                        <p class="medium"><?= htmlspecialchars($artwork['medium']) ?></p>
                        <div class="artwork-actions">
                            <a href="/artworks/<?= $artwork['id'] ?>" class="btn btn-primary">View Details</a>
                            <?php if (!empty($artwork['etsy_url'])): ?>
                                <a href="<?= htmlspecialchars($artwork['etsy_url']) ?>" class="btn btn-success etsy-link" target="_blank">View on Etsy</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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