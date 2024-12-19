<?php
    // if (isset($_GET['error'])) {
    //     echo '<div class="alert alert-danger">wrong email or password</div>';
    // }

?>

<div class="medborder panel">
        <p>logged in as: <?= $_SESSION['user_name'] ?></p>
        <div><button onclick="togglevisibility('overlay', 'flex')" class="smallborder outset">create new drawing</button></div>
        <div><button class="smallborder outset"><a href="./?page=user&id=<?= $_SESSION['user_id'] ?>">my drawings</a></button></div>
        <div><button class="smallborder outset"> <a href="./handlers/handle_logout.php">log out</a></button></div>
</div>