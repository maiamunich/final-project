<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Commission Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/styles/homepage.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .map-container {
            border-radius: 8px;
            overflow: hidden;
            margin-top: 15px;
        }
        .contact-info a {
            color: #d6572b;
            text-decoration: none;
        }
        .contact-info a:hover {
            color: #5cc9e0;
        }
    </style>
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
                        <a class="nav-link" href="/artworks">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-4 mb-4">
                <div class="card medium-section">
                    <div class="card-body">
                        <h2 class="card-title">Contact Information</h2>
                        <div class="contact-info">
                            <p><strong>Email:</strong> <a href="mailto:maia.munich@gmail.com">maia.munich@gmail.com</a></p>
                            <p><strong>Phone:</strong> <a href="tel:+16265314121">(626)531-4121</a></p>
                            <p><strong>Location:</strong> Pasadena, CA</p>
                        </div>
                        <div class="mt-4">
                            <h3>Studio Location</h3>
                            <div class="map-container">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26432.248271425876!2d-118.14430199999999!3d34.1476527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c2dc38330b51%3A0x52b41161ad18f4a!2sPasadena%2C%20CA!5e0!3m2!1sen!2sus!4v1710880000000!5m2!1sen!2sus"
                                    width="100%" 
                                    height="200" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commission Request Form -->
            <div class="col-md-8">
                <div class="card medium-section">
                    <div class="card-body">
                        <h2 class="card-title">Commission Request</h2>
                        <form id="commissionForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Artwork Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" required 
                                    placeholder="Please describe the artwork you'd like me to create. Include details about size, style, subject matter, and any specific requirements."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="budget" class="form-label">Budget Range (Optional)</label>
                                <input type="text" class="form-control" id="budget" name="budget" 
                                    placeholder="e.g., $100-$200">
                            </div>
                            <div class="mb-3">
                                <label for="timeline" class="form-label">Desired Timeline (Optional)</label>
                                <input type="text" class="form-control" id="timeline" name="timeline" 
                                    placeholder="e.g., Within 2 months">
                            </div>
                            <button type="submit" class="btn">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 py-3">
        <div class="container text-center">
            <p id="copyright"></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Set copyright year
            const currentYear = new Date().getFullYear();
            $('#copyright').text(`© ${currentYear} Art Portfolio. All rights reserved.`);

            // Handle form submission
            $('#commissionForm').on('submit', function(e) {
                e.preventDefault();
                
                const formData = {
                    email: $('#email').val(),
                    description: $('#description').val(),
                    budget: $('#budget').val(),
                    timeline: $('#timeline').val()
                };

                $.ajax({
                    url: '/api/commission',
                    method: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    success: function(response) {
                        alert('Thank you for your commission request! I will get back to you soon.');
                        $('#commissionForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        alert('There was an error submitting your request. Please try again later.');
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html> 