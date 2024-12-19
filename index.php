<?php
// boilerplate index

require_once('functions.php');
require_once('db.php');

$pagemain = $_GET['page'] ?? 'gallery';


if (!isset($_SESSION)) {
    session_start();
}

//session_destroy();

$flash_msg = [];
if (isset($_SESSION['flash_msg'])) {
    $flash_msg = $_SESSION['flash_msg'];
    unset($_SESSION['flash_msg']);
}

$loggedin = $_SESSION['loggedin'] ?? false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- Bootstrap 5.3 CSS CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link href="css.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link href="tegaki.css" rel="stylesheet">
    <script type="text/javascript" src="tegaki.js"></script>
</head>
<body>
    <script>
        
    </script>
    
    <?php
    if (!empty($flash_msg)) {
        echo '<div onmouseover="clearTimeout(timer1)" onmouseleave="setTimeout(() => {flash.classList.remove(\'show\')},1000)" id="flash" class="popup show medborder alert alert-' . $flash_msg['type'] . '">' . $flash_msg['text'] . '<a title="close this popup" onclick="flash.classList.remove(\'show\')"> [X] </a>' . '</div>';
    }
    ?>

    

    <main class="bigborder flex">
        <?php
            //debug($_SESSION);
            if (file_exists('./pages/' . $pagemain . '.php')) {
                require_once('./pages/' . $pagemain . '.php');
            } else {
                require_once('./pages/not_found.php');
            }
        ?>
    </main>
    <aside class="flex">
        <a class="home" href="../oekaki">oekaki</a>
            <?php
                if ($loggedin) {
                    require_once('./pages/panel.php');
                } else {
                    require_once('./pages/login.php');
                }
            ?>
    </aside>
        

    <overlay id="overlay" onclick="togglevisibility('overlay', 'flex')">
        <div id="regzone" class="bigborder">
        <?php
                if ($loggedin) {    
                    require_once('./pages/nameprompt.php');
                } else {
                    require_once('./pages/register.php');
                }
            ?>
        </div>
    </overlay>

</body>
</html>

<script>
    function togglevisibility(elementid, defaultstyle){
	if (document.getElementById(elementid).style.display == "none" || document.getElementById(elementid).style.display == ""){
			document.getElementById(elementid).style.display = defaultstyle;
	}
	else document.getElementById(elementid).style.display = "none"
}

    regzone.addEventListener('click', (e) => {  //do not hide overlay when contents clicked
        e.stopPropagation();
    });


    var timer1 = setTimeout(() => {flash.classList.remove('show')},3000);
    

    function opensesame(){
        Tegaki.open({
        // when the user clicks on Finish
        onDone: function() {
            var pngUrl = Tegaki.flatten().toDataURL(); 
            imagedata.value = pngUrl;
            imageform.submit();
        },
        // when the user clicks on Cancel
        onCancel: function() { console.log('Closing...')},
        
        // initial canvas size
        width: 500,
        height: 500
        });
    }

</script>