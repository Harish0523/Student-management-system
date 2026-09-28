<?php
session_start();
require_once "auth.php";
require_once "../config/database.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "DELETE FROM messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: messages.php?msg=deleted");
        exit();
    } else {
        header("Location: messages.php?error=failed");
        exit();
    }
} else {
    header("Location: messages.php");
    exit();
}
?>