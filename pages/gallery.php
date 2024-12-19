<?php


    $offset = $_GET['offset'] ??0;
    $user = $_GET['id'] ?? '';
    $getparams = $_GET;

    $gallery = [];

    if ($user == ''){
        $query = "SELECT post.*, users.username FROM post JOIN users ON post.poster = users.id ORDER BY timestamp DESC LIMIT 10 OFFSET :offset" ;
    } else $query = "SELECT post.*, users.username FROM post JOIN users ON post.poster = users.id WHERE post.poster = :poster ORDER BY timestamp DESC LIMIT 10 OFFSET :offset";
    $stmt = $pdo->prepare($query);
    if ($user == ''){
        $stmt->execute([':offset' => $offset]);
    } else $stmt->execute([':offset' => $offset, ':poster' => $user]);

    while ($row = $stmt->fetch()) {
        $gallery[] = $row;
    }
    //debug($gallery);

?>

<div class="gallery flex">
        <?php
            foreach( $gallery as $row ) {
                echo "<div class='drawingpanel smallborder outset'>" . 
                     "<a href='../oekaki/?page=drawing&id=" . $row['id'] . "'><img src='./images/" . $row['image'] . ".png'></a>" .
                     "<p>". $row['text'] ."</p>".
                     "<hr>".
                     "<p class='flex' style='justify-content:space-between; gap:1em'> <a href='../oekaki/?page=user&id=". $row['poster'] ."'>". $row['username'] ."</a>".
                     "<span>" . $row['timestamp'] . "</span>".
                     "</p>".
                     "</div>";
            }
        ?>
        <nav class='pagenav flex'>
            <a style="<?php if($offset == 0) echo 'filter: brightness(0.7) saturate(4)'; ?>" href="<?php $getparams['offset'] = max(0, $offset-10); echo $_SERVER["PHP_SELF"] . '?' . http_build_query($getparams); ?>"><img src="arrow.png"></a>
            <a href="<?php $getparams['offset'] = $offset+10; echo $_SERVER['PHP_SELF'] . '?' . http_build_query($getparams)?>"><img style="transform: rotate(180deg);" src="arrow.png"></a>
        </nav>
</div>