<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/artworks">Gallery</a></li>
                <li><a href="/about">About</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Art Gallery</h1>
        
        <div class="filters">
            <form id="yearFilter">
                <label for="year">Filter by Year:</label>
                <select name="year" id="year">
                    <option value="">All Years</option>
                    <?php
                    $years = array_unique(array_column($artworks, 'year'));
                    sort($years);
                    foreach ($years as $year) {
                        echo "<option value='$year'>$year</option>";
                    }
                    ?>
                </select>
                <button type="submit">Filter</button>
            </form>

            <form id="classFilter">
                <label for="class">Filter by Class:</label>
                <select name="class" id="class">
                    <option value="">All Classes</option>
                    <?php
                    $classes = array_unique(array_column($artworks, 'class_name'));
                    $classes = array_filter($classes);
                    sort($classes);
                    foreach ($classes as $class) {
                        echo "<option value='$class'>$class</option>";
                    }
                    ?>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>

        <div class="gallery-grid">
            <?php foreach ($artworks as $artwork): ?>
                <div class="artwork-card">
                    <img src="<?= htmlspecialchars($artwork['image_url']) ?>" alt="<?= htmlspecialchars($artwork['title']) ?>">
                    <div class="artwork-info">
                        <h2><?= htmlspecialchars($artwork['title']) ?></h2>
                        <p class="year"><?= htmlspecialchars($artwork['year']) ?></p>
                        <?php if ($artwork['class_name']): ?>
                            <p class="class"><?= htmlspecialchars($artwork['class_name']) ?></p>
                        <?php endif; ?>
                        <p class="medium"><?= htmlspecialchars($artwork['medium']) ?></p>
                        <a href="/artworks/<?= $artwork['id'] ?>" class="view-details">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Your Name. All rights reserved.</p>
    </footer>

    <script src="/assets/js/main.js"></script>
</body>
</html> 