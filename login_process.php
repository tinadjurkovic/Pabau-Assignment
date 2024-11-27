<?php

session_start();
require_once 'config/database.php';

$errors = [
    'required' => 'Both fields are required.',
    'invalidPassword' => 'Incorrect password.',
    'invalidCredentials' => 'This user does not exist.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $_SESSION['errorMessage'] = [];

    if (empty($username) || empty($password)) {
        $_SESSION['errorMessage']['required'] = $errors['required'];
        header('Location: login.php');
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM employees WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user) {
        if ($password === $user['employee_password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            unset($_SESSION['errorMessage']);
            header('Location: vote.php');
            exit;
        } else {
            $_SESSION['errorMessage']['password'] = $errors['invalidPassword'];
            header('Location: login.php');
            exit;
        }
    } else {
        $_SESSION['errorMessage']['invalidCredentials'] = $errors['invalidCredentials'];
        header('Location: login.php');
        exit;
    }
}

header('Location: login.php');
exit;
