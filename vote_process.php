<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'] ?? '';
    $nominee_id = $_POST['nominee_id'] ?? '';
    $comment = trim($_POST['comment'] ?? '');

    if (empty($category_id) || empty($nominee_id) || empty($comment)) {
        $_SESSION['errorMessage'] = "All fields are required.";
        header('Location: vote.php');
        exit;
    }

    if ($nominee_id == $_SESSION['user_id']) {
        $_SESSION['errorMessage'] = "You cannot vote for yourself.";
        header('Location: vote.php');
        exit;
    }

    $stmt = $db->prepare("INSERT INTO votes (voter_id, nominee_id, category_id, comment, timestamp) VALUES (:voter_id, :nominee_id, :category_id, :comment, NOW())");
    $stmt->execute([
        'voter_id' => $_SESSION['user_id'],
        'nominee_id' => $nominee_id,
        'category_id' => $category_id,
        'comment' => $comment
    ]);

    $_SESSION['successMessage'] = "Your vote has been successfully submitted!";
    header('Location: vote.php');
    exit;
}

header('Location: vote.php');
exit;
