<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }

    require 'admin-session-check.php';

    require '../DataBaseConnection.php';

    $managerId = filter_input(INPUT_POST, 'manager_id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM `manager` WHERE manager_id = ?;";
    $prep = $db->prepare($sql);
    $res = $prep->execute([$managerId]);
    if (!$res) {
        header('Location: ?action=users');
        exit;
    }

    $manager = $prep->fetch(PDO::FETCH_OBJ);
    if (!$manager) {
        header('Location: ?action=users');
        exit;
    }

    $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_STRING);
    $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING);
    if ($pass1 != $pass2) {
        header('Location: ?action=change-password&message=1&manager_id=' . $managerId);
        exit;
    }

    if (strlen($pass1) < 6) {
        header('Location: ?action=change-password&message=2&manager_id=' . $managerId);
        exit;
    }

    $sql = 'UPDATE manager SET password_hash = ? WHERE manager_id = ?;';
    $passHash = hash('sha512', $pass1);
    $prep = $db->prepare($sql);
    $res = $prep->execute([$passHash, $managerId]);
    if (!$res) {
        header('Location: ?action=change-password&message=0&manager_id=' . $managerId);
        exit;
    }    

    header('Location: ?action=users&message=3');









