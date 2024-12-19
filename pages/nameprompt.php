<?php

if (!isset($_SESSION)) {
    session_start();
}

//debug($_SESSION);
?>

    
<form id="imageform" class="border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_draw.php">
        <!-- <input type="hidden" class="form-control smallborder" id="poster" name="poster" value="<?php // echo $_SESSION['user_id'] ?>"> -->
        <input type="hidden" class="form-control smallborder" id="imagedata" name="imagedata">
    <div class="">
        <label for="text" class="form-label">Title</label><br>
        <input type="text" class="form-control smallborder" id="text" name="text">
    </div>
</form>

<button onclick="opensesame()" style="display:block;margin-left:auto;margin-right:auto" class="smallborder outset">start drawing</button>