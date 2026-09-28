<?php
session_start();
require_once "auth.php";
require_once "../config/database.php";
/* Total Students */
$studentQuery = $conn->query(
 "SELECT COUNT(*) AS total FROM students"
);
$studentData = $studentQuery->fetch_assoc();
$totalStudents = $studentData["total"];
/* Total Courses */
$courseQuery = $conn->query(
 "SELECT COUNT(DISTINCT course) AS total FROM students"
);
$courseData = $courseQuery->fetch_assoc();
$totalCourses = $courseData["total"];
/* Recent Students */
$recentStudents = $conn->query(
 "SELECT id, name, email, course
 FROM students
 ORDER BY id DESC
 LIMIT 5"
);
?>
<?php
$pageTitle = "Dashboard";
include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta
 name="viewport"
 content="width=device-width, initial-scale=1.0"
 >
 <title>Dashboard</title>
 <link
 rel="stylesheet"
 href="../assets/css/style.css"
 >
</head>
<body>
<div class="dashboard-layout">
 <!-- SIDEBAR -->
 <aside class="sidebar">
 <div class="sidebar-logo">
 Student<span>MS</span>
 </div>
 <nav class="sidebar-nav">
 <a
 href="dashboard"
 class="active"
 >
 Dashboard
 </a>
 <a href="students">
 Students
 </a>
 <a href="add-student">
 Add Student
 </a>
 <a href="messages">
    <i class="fas fa-envelope"></i> Messages
</a>
 </nav>
 <div class="sidebar-bottom">
 <a href="logout.php">
 Logout
 </a>
 </div>
 </aside>
 <!-- MAIN CONTENT -->
 <main class="dashboard-main">
 <!-- TOPBAR -->
 <header class="dashboard-header">
 <div>
 <h1>Dashboard</h1>
 <p>
 Welcome back,
<?php
echo htmlspecialchars(
 $_SESSION["admin_username"]
 );
?>!
 </p>
 </div>
 <div class="admin-profile">
 <div class="profile-avatar">
 A
 </div>
 <span>
 <?php
echo htmlspecialchars(
 $_SESSION["admin_username"]
 );
?>
 </span>
 </div>
 </header>
 <!-- STAT CARDS -->
 <section class="stats-grid">
 <div class="stat-card">
 <div>
 <p>Total Students</p>
 <h2>
 <?php echo $totalStudents; ?>
 </h2>
 </div>
 <div class="stat-icon">
 👨🎓
 </div>
 </div>
 <div class="stat-card">
 <div>
 <p>Total Courses</p>
 <h2>
 <?php echo $totalCourses; ?>
 </h2>
 </div>
 <div class="stat-icon">
 📚
 </div>
 </div>
 <div class="stat-card">
 <div>
 <p>Admin</p>
 <h2>1</h2>
 </div>
 <div class="stat-icon">
 👤
 </div>
 </div>
 </section>
 <!-- RECENT STUDENTS -->
 <section class="dashboard-section">
 <div class="section-header">
 <div>
 <h2>Recent Students</h2>
 <p>
 Latest students added to the system.
 </p>
 </div>
 <a
 href="students.php"
class="primary-btn"
 >
 View All
 </a>
 </div>
 <div class="table-card">
 <?php if ($recentStudents->num_rows > 0): ?>
 <div class="table-wrapper">
 <table>
 <thead>
 <tr>
 <th>ID</th>
<th>Name</th>
<th>Email</th>
 <th>Course</th>
 </tr>
 </thead>
 <tbody>
 <?php while (
 $student =
$recentStudents->fetch_assoc()
 ): ?>
 <tr>
 <td>
 <?php
 echo $student["id"];
 ?>
 </td>
<td>
 <?php
 echo htmlspecialchars(
 $student["name"]
 );
?>
 </td>
<td>
 <?php
echo htmlspecialchars(
 $student["email"]
 );
?>
 </td>
<td>
 <?php
 echo htmlspecialchars(
 $student["course"]
 );
?>
 </td>
 </tr>
 <?php endwhile; ?>
 </tbody>
 </table>
 </div>
 <?php else: ?>
 <div class="empty-state">
 <h3>No Students Yet</h3>
 <p>
 Add your first student.
 </p>
 </div>
 <?php endif; ?>
 </div>
 </section>
 </main>
</div>
</body>
</html>

