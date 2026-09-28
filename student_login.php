<?php
session_start();
require_once "config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM students WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $student = $result->fetch_assoc();
            
            if (password_verify($password, $student['password'])) {
                $_SESSION['student_id'] = $student['id'];
                $_SESSION['student_name'] = $student['name'];
                header("Location: student_dashboard.php");
                exit();
            } else {
                $error = "Incorrect Password!";
            }
        } else {
            $error = "Username not found!";
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
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div style="width: 380px;">
        <div class="card shadow-sm p-4 border-0" style="border-radius: 12px;">
            <h3 class="text-center text-primary fw-bold mb-3">Student Login</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Username</label>
                    <input type="text" name="username" class="form-control" required placeholder="Enter username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Password</label>
                    <input type="password" id="studentPassword" name="password" class="form-control" required placeholder="Enter password">
                    
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePassword()">
                        <label class="form-check-label text-muted" for="showPassword" style="cursor: pointer; font-size: 14px;">
                            Show Password
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Login</button>
            </form>
        </div>

        <!-- Back to Home Link below the Card -->
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-link text-decoration-none text-secondary fw-semibold">
                ← Back to Home
            </a>
        </div>
    </div>

    <script>
    function togglePassword() {
        var pwd = document.getElementById("studentPassword");
        if (pwd.type === "password") {
            pwd.type = "text";
        } else {
            pwd.type = "password";
        }
    }
    </script>
</body>
</html>