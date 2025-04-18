<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maia Nerea Munich - Art Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/styles/homepage.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">Maia Nerea Munich</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/artworks">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
        <section class="hero-section text-center mb-5">
            <h1>Welcome to My Art Portfolio</h1>
            <p class="lead">Visual Artist & Creator</p>
        </section>

        <section class="about-section mb-5">
            <h2>About Me</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="/assets/images/Home_Page_Me_Image.png" alt="Maia Nerea Munich" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <p>
                        Hi, my name is Maia Nerea Munich. I am currently a student at Fordham University studying Computer Science with a 
                        Minor in Visual Arts and Cybersecurity. I started doing art at a very young age, but became fully engrossed by it 
                        in 9th grade and haven't stopped since. I am a very passionate person and I love to create. I love to paint and create art. 
                        I am also very interested in cybersecurity and I am currently working on a project to help people not get scam emails.
                    </p>
                </div>
            </div>
        </section>

        <section class="medium-section mb-5">
            <h2>My Medium</h2>
            <p>
                I love working with acrylic paint, that is my main medium. But have also worked with many different forms such as 
                ceramics, oil, charcoal, and many more. I love to work with many different mediums and I am always trying to learn new things. 
                I am very intrigued by making things with my own hands and I love to see the final product.
            </p>
        </section>

        <section class="statement-section mb-5">
            <h2>Artist Statement</h2>
            <p>
                In my artwork I tend to explore politics and the affect it has on my life. Although most of my recent work 
                has been more focused on more personal lived experiences, I tend to gravitate towards more political and hard subjects. 
                I hope that through my art I am able to make the people who see it think and feel, but also to make them realize they are not alone. 
            </p>
        </section>
    </main>

    <footer class="py-4 mt-5">
        <div class="container text-center">
            <p id="copyright"></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const currentYear = new Date().getFullYear();
            $('#copyright').text(`© ${currentYear} Maia Nerea Munich. All rights reserved.`);
        });
    </script>
</body>
</html> 