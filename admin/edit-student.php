<?php
session_start();
require_once "auth.php";
require_once "../config/database.php";
$error = "";
$success = "";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
 die("Invalid student ID.");
}
/* =========================
 UPDATE STUDENT
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 $name = trim($_POST["name"] ?? "");
 $email = trim($_POST["email"] ?? "");
 $phone = trim($_POST["phone"] ?? "");
 $course = trim($_POST["course"] ?? "");
 $address = trim($_POST["address"] ?? "");
 if ($name === "" || $email === "" || $course === "") {
 $error = "Name, Email and Course are required.";
 } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 $error = "Please enter a valid email address.";
 } else {
 $stmt = $conn->prepare(
 "UPDATE students
 SET name = ?, email = ?, phone = ?, course = ?, address = ?
 WHERE id = ?"
 );
 $stmt->bind_param(
 "sssssi",
 $name,
 $email,
 $phone,
 $course,
 $address,
 $id
 );
 if ($stmt->execute()) {
 $success = "Student updated successfully.";
 } else {
 $error = "Something went wrong.";
 }
 $stmt->close();
 }
}
/* =========================
 GET STUDENT
========================= */
$stmt = $conn->prepare(
 "SELECT id, name, email, phone, course, address
 FROM students
 WHERE id = ?
 LIMIT 1"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 1) {
 die("Student not found.");
}
$student = $result->fetch_assoc();
$stmt->close();
?>
<?php
$pageTitle = "Dashboard";
include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Edit Student</title>
 <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
 <div class="admin-page">
 <div class="admin-container">
 <div class="page-header">
 <div>
 <h1>Edit Student</h1>
 <p>
 Update student information.
 </p>
 </div>
 <a href="students.php" class="secondary-btn">
 Back
 </a>
 </div>
 <?php if ($success): ?>
 <div class="success-message">
 <?php echo htmlspecialchars($success); ?>
 </div>
 <?php endif; ?>
 <?php if ($error): ?>
 <div class="error-message">
 <?php echo htmlspecialchars($error); ?>
 </div>
 <?php endif; ?>
 <div class="form-card">
 <form method="POST">
 <div class="form-group">
 <label for="name">
 Student Name *
 </label>
 <input
 type="text"
id="name"
name="name"
value="<?php echo
htmlspecialchars($student["name"]); ?>"
 required
 >
 </div>
 <div class="form-group">
 <label for="email">
 Email *
 </label>
 <input
 type="email"
id="email"
name="email"
value="<?php echo
htmlspecialchars($student["email"]); ?>"
 required
 >
 </div>
 <div class="form-group">
 <label for="phone">
 Phone
 </label>
 <input
 type="text"
id="phone"
name="phone"
value="<?php echo
htmlspecialchars($student["phone"]); ?>"
 >
 </div>
 <div class="form-group">
 <label for="course">
 Course *
 </label>
 <input
 type="text"
id="course"
name="course"
value="<?php echo
htmlspecialchars($student["course"]); ?>"
 required
 >
 </div>
 <div class="form-group">
 <label for="address">
 Address
 </label>
 <textarea
 id="address"
name="address"
rows="4"
 ><?php echo htmlspecialchars($student["address"]);
?></textarea>
 </div>
 <button type="submit" class="primary-btn">
 Update Student
 </button>
 </form>
 </div>
 </div>
 </div>
 <script src="../assets/js/script.js"></script>
</body>
</html>
