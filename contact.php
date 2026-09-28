<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Student Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

    <!-- Header Hero Section -->
    <div class="bg-primary text-white text-center py-5 mb-5 shadow-sm">
        <h1 class="fw-bold">Contact Us</h1>
        <p class="lead mb-0">Have questions? We are here to help you.</p>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            
            <!-- Left Side: Address & Info Card -->
            <div class="col-md-5">
                <div class="card contact-card border-0 shadow-sm h-100 p-4">
                    <h4 class="text-primary fw-bold mb-4">Get In Touch</h4>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark">Address:</strong>
                            <span class="text-muted">Chavakachcheri, Sri Lanka</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark">Email:</strong>
                            <span class="text-muted">info@studentms.com</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box me-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark">Phone:</strong>
                            <span class="text-muted">+94 76 208 4145</span>
                        </div>
                    </div>

                    <!-- Google Map Location Embed -->
                    <h5 class="text-primary fw-bold mt-2 mb-3">Our Location</h5>
                    <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm border">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125868.2194632639!2d80.05762584703677!3d9.648376059273353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afef9396205c5e1%3A0x24a3609df5a99c9e!2sChavakachcheri!5e0!3m2!1sen!2slk" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="strict-origin-when-cross-origin">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Right Side: Contact Form Card -->
            <div class="col-md-7">
                <div class="card contact-card border-0 shadow-sm p-4">
                    <h4 class="text-primary fw-bold mb-4">Send Us a Message</h4>
                    
                    <form action="send_message.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Name *</label>
                            <input type="text" name="name" class="form-control" required placeholder="Enter your full name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address *</label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Enter topic/subject">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Message *</label>
                            <textarea name="message" class="form-control" rows="5" required placeholder="Type your message here..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit w-100">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="index.php" class="btn btn-outline-primary px-4 py-2 rounded-pill fw-semibold">
                <i class="fas fa-arrow-left me-2"></i> Back to Home
            </a>
        </div>
    </div>

</body>
</html>