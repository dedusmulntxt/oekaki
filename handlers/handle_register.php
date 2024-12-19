<?php

require_once('../functions.php');
require_once('../db.php');

if (!isset($_SESSION)) {
    session_start();
}

$error = '';
foreach ($_POST as $key => $value) {
    if (empty($value)) {
        $error = 'please fill out all fields!';
        break;
    }
}

if (mb_strlen($error) > 0) {
    flash('danger', $error);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    $names = $_POST['names'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $repeat_password = $_POST['repeat_password'] ?? '';

    $query = "SELECT id FROM users WHERE email = :email OR username = :names";
    $stmt = $pdo->prepare($query);
    $params = [
        ':names' => $names,
        ':email' => $email,
    ];
    $stmt->execute($params);
    $user = $stmt->fetch();

    if ($user ) {
        $error = 'user with this email or username already exists';
        flash('danger', $error);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }


    if ($password != $repeat_password) {
        $error = 'passwords do not match';
        flash('danger', $error);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        $hash = password_hash($password, PASSWORD_ARGON2I);

        $query = "INSERT INTO users (username, email, `password`) VALUES (:names, :email, :hash)";
        $stmt = $pdo->prepare($query);
        $params = [
            ':names' => $names,
            ':email' => $email,
            ':hash' => $hash,
        ];

        if ($stmt->execute($params)) {
            flash('success', 'new user successfully created');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $error = 'error creating account';
            flash('danger', $error);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}

?>