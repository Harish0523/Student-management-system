<?php
session_start();
require_once "auth.php";
require_once "../config/database.php";
$search = trim($_GET["search"] ?? "");
$course = trim($_GET["course"] ?? "");
$sql = "
 SELECT id, name, email, phone, course, address, created_at
 FROM students
 WHERE 1=1
";
$params = [];
$types = "";
if ($search !== "") {
 $sql .= " AND (name LIKE ? OR email LIKE ? OR phone LIKE ?)";

 $searchValue = "%" . $search . "%";
 $params[] = $searchValue;
 $params[] = $searchValue;
 $params[] = $searchValue;
 $types .= "sss";
}
if ($course !== "") {
 $sql .= " AND course = ?";
 $params[] = $course;
 $types .= "s";
}
$sql .= " ORDER BY id DESC";
$stmt = $conn->prepare($sql);
if (!empty($params)) {
 $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
/* Get courses for filter */
$courseResult = $conn->query(
 "SELECT DISTINCT course
 FROM students
 WHERE course != ''
 ORDER BY course ASC"
);
/* Total students */
$countResult = $conn->query(
 "SELECT COUNT(*) AS total FROM students"
);
$totalStudents = $countResult->fetch_assoc()["total"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta
 name="viewport"
 content="width=device-width, initial-scale=1.0"
 >
 <title>Students</title>
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
 <a href="dashboard">
 Dashboard
 </a>
 <a href="students" class="active">
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
 <!-- MAIN -->
 <main class="dashboard-main">
 <!-- HEADER -->
 <header class="dashboard-header">
 <div>
 <h1>Students</h1>
 <p>
 Manage all registered students.
 </p>
 </div>
 <a
 href="add-student.php"
 class="primary-btn"
 >
 + Add Student
 </a>
 </header>
 <!-- TOTAL -->
 <div class="student-summary">
 <strong>
 <?php echo $totalStudents; ?>
 </strong>
 <span>
 Total Students
 </span>
 </div>
 <!-- SEARCH -->
 <div class="filter-card">
 <form method="GET" class="filter-form">
 <input
 type="text"
name="search"
placeholder="Search name, email or phone..."
value="<?php echo htmlspecialchars($search); ?>"
 >
 <select name="course">
 <option value="">
 All Courses
 </option>
 <?php while (
 $courseRow =
$courseResult->fetch_assoc()
 ): ?>
 <option
 value="<?php echo
htmlspecialchars($courseRow["course"]); ?>"
 <?php
if ($course === $courseRow["course"]) {
 echo "selected";
 }
?>
 >
 <?php
echo htmlspecialchars(
 $courseRow["course"]
 );
?>

 </option>
 <?php endwhile; ?>
 </select>
 <button
 type="submit"
class="primary-btn"
 >
 Search
 </button>
 <a
 href="students.php"
class="secondary-btn"
 >
 Clear
 </a>
 </form>
 </div>
 <!-- TABLE -->
 <div class="table-card">
 <?php if ($result->num_rows > 0): ?>
 <div class="table-wrapper">
 <table>
 <thead>
 <tr>
 <th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
 <th>Course</th>
 <th>Actions</th>
 </tr>
 </thead>
 <tbody>
 <?php while (
 $student =
 $result->fetch_assoc()
 ): ?>
 <tr>
 <td>
 <?php
echo $student["id"];
?>
 </td>
 <td>
 <strong>
 <?php
 echo htmlspecialchars(
 $student["name"]
 );
?>
 </strong>
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
 $student["phone"]
 );
?>
 </td>
 <td>
 <span class="course-badge">
 <?php
echo htmlspecialchars(
 $student["course"]
 );
 ?>
 </span>
 </td>
 <td>
 <a
 href="edit-student.php?id=<?php echo
$student["id"]; ?>"
 class="edit-btn"
 >
 Edit
 </a>
 <a
 href="delete-student.php?id=<?php echo $student["id"]; ?>"
 class="delete-btn"
>
 Delete
</a>

 </td>
 </tr>
 <?php endwhile; ?>
 </tbody>
 </table>
 </div>
 <?php else: ?>
 <div class="empty-state">
 <h3>No Students Found</h3>
 <p>
 Try another search or add a new student.
 </p>
 <br>
 <a
 href="add-student.php"
class="primary-btn"
 >
 Add Student
 </a>
 </div>
 <?php endif; ?>
 </div>
 </main>
</div>
<script src="../assets/js/script.js"></script>
</body>
</html>
