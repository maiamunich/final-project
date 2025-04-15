<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/gallery.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Art Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/artworks">Gallery</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Art Gallery</h1>

        <!-- Filter Buttons -->
        <div class="filter-section mb-4">
            <div class="year-buttons">
                <h4>Filter by Year</h4>
                <?php foreach ($years ?? [] as $year): ?>
                    <a href="/artworks/year/<?= htmlspecialchars($year) ?>" 
                       class="btn btn-outline-primary <?= isset($currentYear) && $currentYear == $year ? 'active' : '' ?>">
                        <?= htmlspecialchars($year) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="class-buttons mt-3">
                <h4>Filter by Class</h4>
                <?php foreach ($classes ?? [] as $class): ?>
                    <a href="/artworks/class/<?= urlencode($class) ?>" 
                       class="btn btn-outline-secondary <?= isset($currentClass) && $currentClass == $class ? 'active' : '' ?>">
                        <?= htmlspecialchars($class) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Artworks Grid -->
        <div class="row g-4">
            <?php foreach ($artworks as $artwork): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card artwork-card h-100">
                        <img src="<?= htmlspecialchars($artwork['image_url']) ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($artwork['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($artwork['title']) ?></h5>
                            <p class="card-text">
                                <?php if (!empty($artwork['year'])): ?>
                                    <span class="badge bg-primary"><?= htmlspecialchars($artwork['year']) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($artwork['class_name'])): ?>
                                    <span class="badge bg-secondary"><?= htmlspecialchars($artwork['class_name']) ?></span>
                                <?php endif; ?>
                            </p>
                            <p class="card-text"><?= htmlspecialchars($artwork['description'] ?? '') ?></p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Medium: <?= htmlspecialchars($artwork['medium'] ?? 'Not specified') ?><br>
                                    Dimensions: <?= htmlspecialchars($artwork['dimensions'] ?? 'Not specified') ?>
                                </small>
                            </p>
                            <?php if (!empty($artwork['price'])): ?>
                                <p class="card-text">
                                    <strong>Price: $<?= number_format($artwork['price'], 2) ?></strong>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <a href="/artworks/<?= $artwork['id'] ?>" class="btn btn-primary">View Details</a>
                            <?php if (!empty($artwork['etsy_url'])): ?>
                                <a href="<?= htmlspecialchars($artwork['etsy_url']) ?>" 
                                   class="btn btn-success" 
                                   target="_blank">Buy on Etsy</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 