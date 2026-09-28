<?php require_once "config/database.php"; ?> 
<!DOCTYPE html> 
<html lang="en">
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Student Management System</title> 
    
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
</head> 
<body>
 
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <i class="fa-solid fa-graduation-cap"></i> Student<span>MS</span>
            </div> 
            <ul class="nav-links"> 
                <li><a href="index.php">Home</a></li> 
                <li><a href="about.php">About</a></li>  
                <li><a href="contact.php">Contact</a></li>
                <li><a href="student_login.php" class="nav-link">Student Login</a><li>
                                                                   
               
            </ul>
        </div> 
    </nav> 

    <!-- Hero Section --> 
    <section class="hero"> 
        <div class="container hero-content">
            <div class="hero-text"> 
                <span class="badge"><i class="fa-solid fa-bolt"></i> Fast & Reliable System</span> 
                <h1>Manage Students <span>Easy & Fast</span></h1>
                <p class="description"> 
                <marquee> A simple and powerful system to manage student information, academic details, and records all from one place. </marquee>
                </p>
                <div class="hero-buttons">
                    
                    <a href="#features" class="secondary-btn">
                        Learn More  
                    </a>
                </div> 
            </div> 
            <!-- Hero Illustration/Image Add  -->
            <div class="hero-image">
                <img src="./assets/images/student.jpg" alt="Student Management Illustration">
            </div>
        </div> 
    </section>
    <!-- Available Courses Section -->
<section class="courses-section" id="courses">
    <div class="container">
        
        <!-- Section Header -->
        <div class="section-title">
            <p class="sub-title">OUR OFFERINGS</p> 
            <h2 class="main-title">Available Courses</h2>
        </div>
        
        <!-- Courses Cards Grid Container -->
        <div class="courses-grid">
            
            <!-- Card 1: Web Development -->
            <div class="course-card">
                <div class="course-icon">
                    <i class="fa-solid fa-code"></i>
                </div>
                <h3>Web Development</h3>
                <p>Learn Full-Stack Web Development using HTML, CSS, JavaScript, PHP, and MySQL database management.</p>
            </div>

            <!-- Card 2: Data Science -->
            <div class="course-card">
                <div class="course-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3>Data Science</h3>
                <p>Master Python programming, Data Visualization, Machine Learning, and SQL database queries.</p>
            </div>

            <!-- Card 3: Graphic Design -->
            <div class="course-card">
                <div class="course-icon">
                    <i class="fa-solid fa-palette"></i>
                </div>
                <h3>Graphic Design</h3>
                <p>Understand UI/UX design concepts, Adobe Photoshop, Illustrator, and branding techniques.</p>
            </div>

            <!-- Card 4: Accounting -->
            <div class="course-card">
                <div class="course-icon">
                    <i class="fa-solid fa-calculator"></i>
                </div>
                <h3>Accounting</h3>
                <p>Master corporate financial accounting basics, QuickBooks, Tally, and auditing workflows.</p>
            </div>

        </div>
    </div>
</section>

    <!-- Features -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-title">
                <p>FEATURES</p> 
                <h2>Everything You Need</h2>
            </div>
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="icon-box">➕</i></div>
                    <h3>Add Students</h3>
                    <p>Easily add new student information to the system instantly.</p> 
                </div>
                <div class="feature-card">
                    <div class="icon-box">👥</i></div> 
                    <h3>View Students</h3>
                    <p>View all registered students easily from the admin dashboard.</p> 
                </div>
                <div class="feature-card"> 
                    <div class="icon-box">✏️</i></div> 
                    <h3>Edit Information</h3>
                    <p>Update student records and profile details whenever necessary.</p>
                </div> 
                <div class="feature-card"> 
                    <div class="icon-box">🗑️</i></div> 
                    <h3>Delete Students</h3>
                    <p>Remove unnecessary or outdated student records safely.</p>
                </div>
            </div>
        </div>
    </section> 
    

  <footer class="custom-footer">
    <div class="footer-container">
        
        <!-- LEFT COLUMN: Logo & Address -->
        <div class="footer-col footer-left">
            <div class="footer-logo">
                <i class="fas fa-graduation-cap"></i> Student <span>MS</span>
            </div>
            <div class="contact-info">
                <p><i class="fas fa-map-marker-alt"></i> Chavakachcheri, Sri Lanka</p>
                <p><i class="fas fa-phone"></i> +94 76 208 4145</p>
                <p><i class="fas fa-envelope"></i> info@studentms.com</p>
            </div>
        </div>

        <!-- CENTER COLUMN: Student Details -->
        <div class="footer-col footer-center">
            <h3>Student Details</h3>
            <p>Our Student Management System helps to efficiently organize student records, attendance, and course structures with an easy-to-use interface.</p>
        </div>

        <!-- RIGHT COLUMN: Menu Bar -->
        <div class="footer-col footer-right">
            <h3>Menu</h3>
            <ul class="footer-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="student_login.php">Student Login</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Student Management System. All Rights Reserved.</p>
    </div>
</footer>

<!-- FontAwesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Bootstrap JS & Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="assets/js/script.js"></script>
</body> 
</html>