<?php

require_once('../functions.php');
require_once('../db.php');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$login_error = false;

if (!isset($_SESSION)) {
    session_start();
}

if (empty($email) || empty($password)) {
    $login_error = true;
} else {
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        $login_error = true;
    } else {
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['loggedin'] = true;
            setcookie('user_email', $user['email'], time() + 3600, '/', 'localhost', false, true);
        } else {
            $login_error = true;
        }
    }
}

if ($login_error) {
    flash('danger', 'Wrong e-mail or password');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    //
    exit;
}

if (isset($_SESSION['user_name'])) {
    flash('success', 'logged in successfully');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    flash('danger', 'error logging in');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}