<?php

require_once('../functions.php');
require_once('../db.php');

if (!isset($_SESSION)) {
    session_start();
}

$text = $_POST['text'] ?? '';
$imagedata = $_POST['imagedata'] ?? '';
$unixtime = $_SERVER['REQUEST_TIME_FLOAT']*10000; //4chan style filenames based on microsecond unix timestamp. prevents any sort of name collision
$poster = $_SESSION['user_id'];


//debug($_POST);
//debug($_SESSION);

if(!isset($_SESSION['user_id'])) {
    flash('danger', 'error: no user id (?)');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if(empty($imagedata)){
    flash('danger', 'error: no image data was sent (?)');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if(strcmp(substr($imagedata, 0, 22), 'data:image/png;base64,' ) !== 0){
    flash('danger', 'error: invalid image data (?)');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}



file_put_contents('../images/' . $unixtime . '.png', file_get_contents($_POST["imagedata"]));

//echo "<img src='" . $_POST['imagedata'] . "'>";

$query = "INSERT INTO post (text, image, poster) VALUES (:text, :image, :poster)";
$stmt = $pdo->prepare($query);
$params = [
    ':text' => $text,
    ':image' => $unixtime,
    ':poster' => $poster,
];


//debug($imageid);

if ($stmt->execute($params)) {
    $query2 = "SELECT id FROM post WHERE poster = :poster ORDER BY timestamp DESC LIMIT 1";          //get of new image
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute([':poster' => $poster]);
    $imageid = $stmt2->fetch();
    flash('success', 'image uploaded successfully');
    header('Location: ' . '../?page=drawing&id=' . $imageid['id']);
    exit;
} else {
    flash('danger', 'error creating image');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
    



//copy('$_POST["imagedata"]', '../images/testimg.png');
//

?>

