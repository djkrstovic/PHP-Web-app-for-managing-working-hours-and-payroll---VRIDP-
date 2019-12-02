<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    require 'DataBaseConnection.php';

	$sql = 'SELECT * FROM admin WHERE username = ? AND password_hash = ? AND is_active = 1;';
	$prep = $db->prepare($sql);
    $res = $prep->execute([$username, hash('sha512', $password)]);
	
    $message = 'Ne postoji admin sa uentim korisnickim imenom ili lozinkom ili nalog nije aktivan.';

	if ($res) {
		$admin = $prep->fetch(PDO::FETCH_OBJ);

        if ($admin) {
            $_SESSION['admin_id'] = $admin->admin_id;
            $_SESSION['username'] = $admin->username;

            setcookie(session_name(), session_id(), time() + 60*60*24*2);

            ob_clean();
            header('Location: ./admin/index.php?action=notifications');
            exit;
        }
	}
	
