<?php
session_start();
require_once "config/database.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - StudentMS</title>
    
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Link -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head> 
<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div>
            <div class="sidebar-brand">
                <i class="fa-solid fa-graduation-cap"></i> Student<span>MS</span>
            </div>
            <ul class="sidebar-menu">
                <li><a href="student_dashboard.php" class="active"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                <li><a href="index.php"><i class="fa-solid fa-globe"></i> Home Page</a></li>
            </ul>
        </div>
    </aside>

    <!-- Main Section Wrapper -->
    <div class="main-wrapper">
        
        <!-- Top Navbar Header -->
        <header class="top-navbar">
            <div class="user-welcome">
                Welcome back, <span><?php echo htmlspecialchars($student['name']); ?></span> 👋
            </div>
            <div class="header-actions">
                <a href="logout.php" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="dashboard-container">

            <!-- Stat Cards Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-user-check"></i></div>
                    <div class="stat-info">
                        <h4>Status</h4>
                        <p>Active Student</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-book-bookmark"></i></div>
                    <div class="stat-info">
                        <h4>Enrolled Course</h4>
                        <p><?php echo htmlspecialchars($student['course']); ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-hashtag"></i></div>
                    <div class="stat-info">
                        <h4>Student ID</h4>
                        <p>#<?php echo htmlspecialchars($student['id']); ?></p>
                    </div>
                </div>
            </div>

            <!-- Profile Details Card -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3><i class="fa-regular fa-id-badge"></i> My Details</h3>
                    <span class="status-badge"><i class="fa-solid fa-circle-check"></i> Verified</span>
                </div>

                <div class="profile-body">
                    <!-- Profile Avatar Block -->
                    <div class="avatar-box">
                        <div class="avatar">
                            <?php echo strtoupper(substr($student['name'], 0, 1)); ?>
                        </div>
                    </div>

                    <!-- Information Details Grid -->
                    <div class="details-grid">
                        <div class="detail-item">
                            <label>Name</label>
                            <span><?php echo htmlspecialchars($student['name']); ?></span>
                        </div>

                        <div class="detail-item">
                            <label>Email</label>
                            <span><?php echo htmlspecialchars($student['email']); ?></span>
                        </div>

                        <div class="detail-item">
                            <label>Phone</label>
                            <span><?php echo htmlspecialchars($student['phone']); ?></span>
                        </div>

                        <div class="detail-item">
                            <label>Course</label>
                            <span><?php echo htmlspecialchars($student['course']); ?></span>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body> 
</html>