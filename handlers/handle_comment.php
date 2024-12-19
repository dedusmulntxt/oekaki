<?php

require_once('../functions.php');
require_once('../db.php');

if (!isset($_SESSION)) {
    session_start();
}

debug($_POST);
debug($_SESSION);

$commenttext = $_POST['commenttext'] ?? '';
$parent = $_POST['parent'] ?? '';
$poster = $_SESSION['user_id'] ?? '';

if(!isset($_SESSION['user_id'])) {
    flash('danger', 'error: no user id (?)');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if(empty($commenttext)){
    flash('success', 'error: um you forgot the comment');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if(empty($parent)){
    flash('success', 'error: invalid parent post');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$query = "SELECT * FROM post WHERE id = :id";
$stmt = $pdo->prepare($query);      //check if parent post exists
$stmt->execute(['id' => $parent]);
$idcheck = $stmt->fetch();

if(!$idcheck){
    flash('success', 'error: invalid parent post');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$query = "INSERT INTO comment (text, parent, poster) VALUES (:text, :parent, :poster)";
$stmt = $pdo->prepare($query);
$params = [
    ':text' => $commenttext,
    ':parent' => $parent,
    ':poster' => $poster,
];

if ($stmt->execute($params)) {
    flash('success', 'comment added successfully');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    flash('danger', 'error making comment');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}



?>