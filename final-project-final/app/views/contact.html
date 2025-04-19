<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Commission Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/styles/homepage.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .feedback-message {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            display: none;
        }
        .feedback-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .feedback-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .contact-info {
            margin-bottom: 30px;
        }
        .contact-info p {
            margin-bottom: 10px;
        }
        .map-container {
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
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

    <div class="container mt-4">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Contact Information</h2>
                        <div class="contact-info">
                            <p><strong>Email:</strong> <a href="mailto:maia.munich@gmail.com">maia.munich@gmail.com</a></p>
                            <p><strong>Phone:</strong> <a href="tel:+16265314121">(626)531-4121</a></p>
                            <p><strong>Location:</strong> Pasadena, CA</p>
                        </div>
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

            <!-- Commission Request Form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Commission Request</h2>
                        <p>Interested in a custom piece? Fill out the form below and I'll get back to you as soon as possible!</p>
                        
                        <!-- Feedback Messages -->
                        <div id="feedbackMessage" class="feedback-message"></div>

                        <form id="commissionForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description of Commission</label>
                                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                                <small class="form-text text-muted">Please describe what you're looking for in as much detail as possible.</small>
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

    <script>
        $(document).ready(function() {
            // Set copyright year
            const currentYear = new Date().getFullYear();
            $('#copyright').text(`© ${currentYear} Art Portfolio. All rights reserved.`);

            // Function to show feedback message
            function showFeedback(message, isError = false) {
                const messageDiv = $('#feedbackMessage');
                messageDiv.removeClass('success error').addClass(isError ? 'error' : 'success');
                messageDiv.text(message).fadeIn();
                
                if (!isError) {
                    setTimeout(() => {
                        messageDiv.fadeOut();
                    }, 5000);
                }
            }

            // Handle form submission
            $('#commissionForm').on('submit', function(e) {
                e.preventDefault();

                const formData = {
                    name: $('#name').val().trim(),
                    email: $('#email').val().trim(),
                    description: $('#description').val().trim()
                };

                // Disable form while submitting
                const submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);

                $.ajax({
                    url: '/api/commission',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        showFeedback('Thank you for your commission request! I will get back to you soon.');
                        $('#commissionForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = 'An error occurred. Please try again.';
                        
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        } else if (xhr.status === 500) {
                            errorMessage = 'Server error. Please try again later.';
                        } else if (xhr.status === 400) {
                            errorMessage = 'Please check your input and try again.';
                        } else if (xhr.status === 0) {
                            errorMessage = 'Unable to connect to the server. Please check your internet connection.';
                        }
                        
                        showFeedback(errorMessage, true);
                    },
                    complete: function() {
                        // Re-enable form after submission complete
                        submitButton.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html> 