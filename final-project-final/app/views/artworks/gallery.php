<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Maia Nerea Munich</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/gallery.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Maia Nerea Munich</a>
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

    <main class="container mt-5">
        <h1 class="text-center mb-5">Art Gallery</h1>

        <!-- Year Navigation -->
        <div class="year-navigation mb-4">
            <h2>Browse by Year</h2>
            <div class="year-buttons">
                <?php
                $years = array_unique(array_column($artworks, 'year'));
                rsort($years);
                foreach ($years as $year) {
                    echo "<a href='/artworks/year/$year' class='btn btn-outline-primary me-2'>$year</a>";
                }
                ?>
            </div>
        </div>

        <!-- Class Navigation -->
        <div class="class-navigation mb-4">
            <h2>Browse by Class</h2>
            <div class="class-buttons">
                <?php
                $classes = array_unique(array_column($artworks, 'class_name'));
                $classes = array_filter($classes);
                sort($classes);
                foreach ($classes as $class) {
                    echo "<a href='/artworks/class/" . urlencode($class) . "' class='btn btn-outline-secondary me-2'>$class</a>";
                }
                ?>
            </div>
        </div>

        <!-- Artworks Grid -->
        <div class="artworks-grid">
            <?php foreach ($artworks as $artwork): ?>
                <div class="artwork-card" data-year="<?= $artwork['year'] ?>" data-class="<?= htmlspecialchars($artwork['class_name'] ?? '') ?>">
                    <div class="artwork-image">
                        <img src="<?= htmlspecialchars($artwork['image_url']) ?>" alt="<?= htmlspecialchars($artwork['title']) ?>">
                    </div>
                    <div class="artwork-info">
                        <h3><?= htmlspecialchars($artwork['title']) ?></h3>
                        <p class="year"><?= $artwork['year'] ?></p>
                        <?php if ($artwork['class_name']): ?>
                            <p class="class"><?= htmlspecialchars($artwork['class_name']) ?></p>
                        <?php endif; ?>
                        <p class="medium"><?= htmlspecialchars($artwork['medium']) ?></p>
                        <div class="artwork-actions">
                            <a href="/artworks/<?= $artwork['id'] ?>" class="btn btn-primary">View Details</a>
                            <?php if ($artwork['etsy_url']): ?>
                                <a href="<?= htmlspecialchars($artwork['etsy_url']) ?>" class="btn btn-success etsy-link" target="_blank">View on Etsy</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p>&copy; <?= date('Y') ?> Maia Nerea Munich. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/gallery.js"></script>
</body>
</html> 