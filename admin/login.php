<?php
session_start();
require_once "../config/database.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 $username = trim($_POST["username"] ?? "");
 $password = $_POST["password"] ?? "";
 if ($username === "" || $password === "") {
 $error = "Please enter username and password.";
 } else {
 $stmt = $conn->prepare(
 "SELECT id, username, password FROM admins WHERE username = ?
LIMIT 1"
 );
 $stmt->bind_param("s", $username);
 $stmt->execute();
 $result = $stmt->get_result();
 if ($result->num_rows === 1) {
 $admin = $result->fetch_assoc();
 if (password_verify($password, $admin["password"])) {
 session_regenerate_id(true);
 $_SESSION["admin_id"] = $admin["id"];
 $_SESSION["admin_username"] = $admin["username"];
 header("Location: dashboard.php");
 exit;
 } else {
 $error = "Invalid username or password.";
 }
 } else {
 $error = "Invalid username or password.";
 }
 $stmt->close();
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Admin Login</title>
 <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
 <div class="login-container">
 <div class="login-box">
 <h1>Admin Login</h1>
 <p>Login to Student Management System</p>
 <?php if ($error): ?>
 <div class="error-message">
 <?php echo htmlspecialchars($error); ?>
 </div>
 <?php endif; ?>
 <form method="POST">
 <label>Username</label>
 <input
 type="text"
name="username"
placeholder="Enter username"
required
 >
 <label>Password</label>
 <div class="password-wrapper">
 <input
 type="password"
 id="password"
 name="password"
 placeholder="Enter password"
 required
 >
 <button
 type="button"
 id="password-toggle"
 >
 Show
 </button>
</div>
 <button type="submit">
 Login
 </button>
 </form>
 </div>
 </div>
 <script src="../assets/js/script.js"></script>
</body>
</html>