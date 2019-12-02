<?php
    define('VALID_ENTRY', TRUE);

    session_start();

    if ($_POST) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

        if (preg_match('|^[A-z0-9]+@.+$|', $username)) {
            require 'user/do_login.php';
        } else {
            require 'admin/do_login.php';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Logovanje </title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form class="login-box" method="post">
            <h1>Logovanje</h1>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Korisničko ime" name="username" value="">
            </div>
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Lozinka" name="password" value="">
            </div>
            <input class="btn" type="submit" name="" value="Uloguj se">

            <?php if (isset($message)): ?>
                <p>Greska: <?php echo $message; ?></p>
            <?php endif; ?>
        </form>
        
        <script>
            window.addEventListener('load', prikazLogin);
            
            function prikazLogin() {
                setTimeout(function(){
                    document.querySelector('.login-box').style.marginTop = 'calc(50vh - 170px)';
                    document.querySelector('.login-box').style.opacity = '1.0';
                }, 100);
            }
        </script>
    
    </body>
</html>
