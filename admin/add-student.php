<?php 
session_start(); 
require_once "auth.php"; 
require_once "../config/database.php"; 
require_once "../config/csrf.php";

$message = ""; 
$error = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $name     = trim($_POST["name"] ?? ""); 
    $email    = trim($_POST["email"] ?? ""); 
    $phone    = trim($_POST["phone"] ?? ""); 
    $course   = trim($_POST["course"] ?? ""); 
    $address  = trim($_POST["address"] ?? ""); 
    $username = trim($_POST["username"] ?? ""); 
    $password = $_POST["password"] ?? ""; 

    if ($name === "" || $email === "" || $course === "" || $username === "" || $password === "") { 
        $error = "Name, Email, Course, Username and Password are required."; 
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $error = "Please enter a valid email address."; 
    } else { 
        $checkStmt = $conn->prepare("SELECT id FROM students WHERE username = ? LIMIT 1");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $error = "Username already taken! Please choose another.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare( 
                "INSERT INTO students (name, email, phone, course, address, username, password) 
                 VALUES (?, ?, ?, ?, ?, ?, ?)" 
            ); 

            $stmt->bind_param( 
                "sssssss", 
                $name, 
                $email, 
                $phone, 
                $course, 
                $address,
                $username,
                $hashed_password
            ); 

            if ($stmt->execute()) { 
                $message = "Student added successfully!"; 
            } else { 
                $error = "Something went wrong. Please try again."; 
            } 

            $stmt->close(); 
        }
        $checkStmt->close();
    } 
} 
?> 
<?php
$pageTitle = "Add Student";
include "../includes/header.php";
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Add Student</title> 
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head> 
<body> 
    <div class="admin-page"> 
        <div class="admin-container"> 
            <div class="page-header"> 
                <div> 
                    <h1>Add Student</h1> 
                    <p>Add a new student to the database.</p> 
                </div> 

                <a href="students.php" class="secondary-btn">Back</a> 
            </div> 

            <?php if ($message): ?> 
                <div class="success-message"> 
                    <?php echo htmlspecialchars($message); ?> 
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
                        <label for="name">Student Name *</label> 
                        <input type="text" id="name" name="name" placeholder="Enter student name" required> 
                    </div> 

                    <div class="form-group"> 
                        <label for="email">Email *</label> 
                        <input type="email" id="email" name="email" placeholder="student@example.com" required> 
                    </div> 

                    <div class="form-group"> 
                        <label for="phone">Phone *</label> 
                        <input type="text" id="phone" name="phone" placeholder="0771234567"> 
                    </div> 

                    <div class="form-group"> 
                        <label>Select Course *</label>
                        <select name="course" class="form-control" style="width: 100%; padding: 10px; font-size: 16px;" required>
                            <option value="">-- Choose Course --</option>
                            <option value="Web Development">Web Development</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Graphic Design">Graphic Design</option>    
                            <option value="Accounting">Accounting</option>
                        </select>
                    </div> 

                    <div class="form-group"> 
                        <label for="address">Address</label> 
                        <textarea id="address" name="address" rows="4" placeholder="Enter address"></textarea> 
                    </div> 

                    <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 25px 0;">
                    <h3 style="font-size: 18px; color: #1e293b; margin-bottom: 15px;">Student Login Credentials</h3>

                    <div class="form-group"> 
                        <label for="username">Username *</label> 
                        <input type="text" id="username" name="username" placeholder="Create username" required> 
                    </div> 

                    <div class="form-group"> 
                        <label for="password">Password *</label> 
                        <div style="position: relative;">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Create password" 
                                style="width: 100%; padding-right: 40px;"
                                required
                            > 
                            <button 
                                type="button" 
                                id="togglePassword" 
                                onclick="togglePasswordVisibility()"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; font-size: 14px;"
                            >
                                👁️
                            </button>
                        </div>
                    </div> 

                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrf_token()); ?>">

                    <button type="submit" class="primary-btn">Add Student</button> 
                </form> 
            </div> 
        </div> 
    </div> 

    <script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const toggleBtn = document.getElementById("togglePassword");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleBtn.textContent = "🙈";
        } else {
            passwordInput.type = "password";
            toggleBtn.textContent = "👁️";
        }
    }
    </script>
    <script src="../assets/js/script.js"></script>
</body> 
</html>