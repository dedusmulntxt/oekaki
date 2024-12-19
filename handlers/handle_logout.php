<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    session_destroy();
    //flash('success', 'logged out successfully');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>