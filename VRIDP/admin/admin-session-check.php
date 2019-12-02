<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }

    session_start();

    if (!isset($_SESSION['admin_id'])) {
        ob_clean();
		header('Location: ../logout.php');
		exit;
    }

