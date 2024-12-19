<?php
    // if (isset($_GET['error'])) {
    //     echo '<div class="alert alert-danger">wrong email or password</div>';
    // }
?>

<form class="medborder" method="POST" action="./handlers/handle_login.php">
    <h3 class="text-center">Log in</h3>
    <div class="mb-3">
        <label for="email" class="form-label">e-mail</label>
        <input type="email" class="form-control smallborder" id="email" name="email" value="<?php echo $_COOKIE['user_email'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="password" class="form-control smallborder" id="password" name="password">
    </div>
    <button type="submit" class="smallborder outset">Log in</button>
    <button type="button" onclick="togglevisibility('overlay', 'flex')" class="smallborder outset">Register</button>
</form>