<?php

?>

<form class="border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_register.php">
    <h3 class="text-center">Register</h3>
    <div class="">
        <label for="names" class="form-label">Name</label><br>
        <input type="names" class="form-control smallborder" id="names" name="names" value="<?php echo $flash['data']['names'] ?? '' ?>">
    </div>
    <div class="">
        <label for="email" class="form-label">Email</label><br>
        <input type="email" class="form-control smallborder" id="email" name="email" value="<?php echo $flash['data']['email'] ?? '' ?>">
    </div>
    <div class="">
        <label for="password" class="form-label">Password</label><br>
        <input type="password" class="form-control smallborder" id="password" name="password">
    </div>
    <div class="">
        <label for="repeat_password" class="form-label">Repeat password</label><br>
        <input type="password" class="form-control smallborder" id="repeat_password" name="repeat_password">
    </div>
    <div>
        <button style="display:block;margin-left:auto;margin-right:auto" type="submit" class="smallborder outset">Register</button>
    </div>
</form>