<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

    require '../DataBaseConnection.php';

    if (!$_POST) {
        header('Location: UWorkLogForm.php');
        exit;
    }

    # $ime     = filter_input(INPUT_POST, 'aime',     FILTER_SANITIZE_STRING);
    # $prezime = filter_input(INPUT_POST, 'aprezime', FILTER_SANITIZE_STRING);
    # $jmbg    = filter_input(INPUT_POST, 'jmbg',     FILTER_SANITIZE_NUMBER_INT);

	$nacinDodavanja = filter_input(INPUT_POST, 'nacin_dodavanja', FILTER_SANITIZE_STRING);

	$zaposleni = filter_input(INPUT_POST, 'zaposleni_full_data', FILTER_SANITIZE_STRING);
	
    $mesec   = filter_input(INPUT_POST, 'mesec',    FILTER_SANITIZE_NUMBER_INT);
    $godina  = filter_input(INPUT_POST, 'godina',   FILTER_SANITIZE_NUMBER_INT);
    $sati    = filter_input(INPUT_POST, 'rsati',    FILTER_SANITIZE_NUMBER_INT);
    $satnica = filter_input(INPUT_POST, 'satnica',  FILTER_SANITIZE_NUMBER_FLOAT);
    $sati_odsutan = filter_input(INPUT_POST, 'sati_odsutan',  FILTER_SANITIZE_NUMBER_FLOAT);
    $satnica_odsutan = filter_input(INPUT_POST, 'satnica_odsutan',  FILTER_SANITIZE_NUMBER_FLOAT);
    $sati_neplaceno = filter_input(INPUT_POST, 'sati_neplaceno',  FILTER_SANITIZE_NUMBER_FLOAT);

    $managerId = $_SESSION['manager_id'];
	
	$sql = "SELECT employee_id FROM employee WHERE CONCAT(forename, ' ', surname, ' ', jmbg) = ?;";
	$prep = $db->prepare($sql);
    $res = $prep->execute([$zaposleni]);

	if (!$res) {
		header('location: ?action=log/add&message=0');
		exit;
	}

	$employee_id = $prep->fetch(PDO::FETCH_OBJ)->employee_id;
	
	$sql = 'SELECT work_log_id FROM work_log WHERE employee_id = ? AND `year` = ? AND `month` = ?;';
	$prep = $db->prepare($sql);
	$res = $prep->execute([
		$employee_id,
		$godina,
		$mesec
	]);

	$row = $prep->fetch(PDO::FETCH_OBJ);

	if ($row) {
		$work_log_id = $row->work_log_id;
		
		$sql = 'UPDATE work_log SET
					hours_worked = ?,
					hours_price = ?,
					hours_absent_paid = ?,
					hours_absent_price = ?,
					hours_absent_unpaid = ?
				WHERE work_log_id = ?;';
		$prep = $db->prepare($sql);
		$res = $prep->execute([
			$sati,
			$satnica,
			$sati_odsutan,
			$satnica_odsutan,
			$sati_neplaceno,
			$work_log_id
		]);
	} else {
		$sql = 'INSERT work_log SET
					manager_id = ?,
					employee_id = ?,
					hours_worked = ?,
					hours_price = ?,
					hours_absent_paid = ?,
					hours_absent_price = ?,
					hours_absent_unpaid = ?,
					month = ?,
					year = ?;';

		$prep = $db->prepare($sql);
		$res = $prep->execute([
			$managerId,
			$employee_id,
			$sati,
			$satnica,
			$sati_odsutan,
			$satnica_odsutan,
			$sati_neplaceno,
			$mesec,
			$godina
		]);
	}

	if ($res) {
		if ($nacinDodavanja == 'Evidentiraj i otvori listu') {
			header('location: ?action=log&message=1');
			exit;
		}

		header('location: ?action=log/add&message=1');
		exit;
	}

    header('location: ?action=log/add&message=0');
