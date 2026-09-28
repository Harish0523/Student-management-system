<?php
session_start();
require_once "auth.php";
require_once "../config/database.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
 die("Invalid student ID.");
}
/* =========================
 DELETE STUDENT
========================= */
$stmt = $conn->prepare(
 "DELETE FROM students WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
/* =========================
 REDIRECT
========================= */
header("Location: students.php");
exit;
?>
