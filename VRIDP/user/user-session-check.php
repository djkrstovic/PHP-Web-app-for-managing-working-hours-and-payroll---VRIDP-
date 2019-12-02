<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    session_start();

    if (!isset($_SESSION['manager_id'])) {
        ob_clean();
		header('Location: ../logout.php');
		exit;
    }

