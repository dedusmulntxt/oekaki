<?php

    $gallery = [];
    $comments = [];
    //$query = "SELECT * FROM post";
    $postid = $_GET['id'];
    

    $query = "SELECT post.*, users.username FROM post JOIN users ON post.poster = users.id WHERE post.id = :postid";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':postid' => $postid]);

    while ($row = $stmt->fetch()) {
        $gallery[] = $row;
    }

    //debug($gallery);

    $cquery = "SELECT comment.*, username FROM comment JOIN users ON comment.poster = users.id WHERE comment.parent = :postid ORDER BY timestamp DESC" ;
    $cstmt = $pdo->prepare($cquery);
    $cstmt->execute([':postid' => $postid]);

    while ($row = $cstmt->fetch()) {
        $comments[] = $row;
    }

    //debug($comments);

?>

<div class="gallery single flex" style="flex-direction:column; width: fit-content;">
        <?php
            foreach( $gallery as $row ) {
                echo "<div class='singledrawing smallborder outset'>" . 
                     "<img src='./images/" . $row['image'] . ".png'>" .
                     "<p>". $row['text'] ."</p>".
                     "<hr>".
                     "<p> <a href='../oekaki/?page=user&id=". $row['poster'] ."'>". $row['username'] ."</a></p>".
                     "</div>";
            }
        ?>
        
</div>

<form style="display:<?php if(!$loggedin) {echo 'none';} ?>" class="commentbox flex" method="POST" action="./handlers/handle_comment.php">
    <!-- <input class="smallborder" type="text" id="commenttext" name="commenttext"> -->
    <textarea class="smallborder" id="commenttext" name="commenttext"></textarea>
    <input type="hidden" type="text" id="parent" name="parent" value="<?= $postid ?>">
    <button type="submit" class="smallborder outset">submit</button>
</form>

<?php
            foreach( $comments as $row ) {
                echo "<div class='flex commentbox smallborder'>" . 
                     "<p class='flex' style='justify-content:space-between; gap:1em;'> <a href='../oekaki/?page=user&id=". $row['poster'] ."'>". $row['username'] .":</a>".
                     "<span>" . $row['timestamp'] . "</span>".
                     "</p>".
                     "<p>" . $row['text'] .
                     "</p>" .
                     "</div>";
            }
        ?>