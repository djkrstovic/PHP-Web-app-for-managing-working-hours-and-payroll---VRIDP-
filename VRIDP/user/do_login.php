<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    require 'DataBaseConnection.php';

	$sql = 'SELECT * FROM manager WHERE email = ? AND password_hash = ? AND is_active = 1;';
	$prep = $db->prepare($sql);
    $res = $prep->execute([$username, hash('sha512', $password)]);
	
    $message = 'Ne postoji menadžer sa unetim korisničkim imenom ili lozinkom ili nalog nije aktivan.';

	if ($res) {
		$manager = $prep->fetch(PDO::FETCH_OBJ);

        if ($manager) {
            $_SESSION['manager_id'] = $manager->manager_id;
            $_SESSION['forename']   = $manager->forename;
            $_SESSION['surname']    = $manager->surname;

            setcookie(session_name(), session_id(), time() + 60*60*24*2);

            ob_clean();
            header('Location: ./user/index.php?action=notifications');
            exit;
        }
	}
	
