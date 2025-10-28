<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'M') {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: activity.php');
    exit;
}

require_once 'db.php';

try {
    $stmt = $conn->prepare("DELETE FROM event WHERE id = ?");
    $stmt->execute([$_GET['id']]);
} catch (PDOException $e) {
    error_log("Delete error: " . $e->getMessage());
}

header('Location: activity.php?deleted=1');
exit;