<?php
    define('VALID_ENTRY', TRUE);

	$action = trim(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING));
	
	if ($action == '') {
		$action = 'notifications';
	}

	$fileToLoad = '';

	switch ($action) {
		case 'report/yearly-totals'	       : $fileToLoad = 'UGodisnjePlate.php'; break;
		case 'report/yearly-hours'	       : $fileToLoad = 'UPodelaSati.php'; break;
		case 'report/yearly-hours-global'  : $fileToLoad = 'UPodelaSatiUkupno.php'; break;
		case 'notifications' 		       : $fileToLoad = 'UNotifPg.php'; break;
		case 'notifications/add' 	       : $fileToLoad = 'Unotifcreate.php'; break;
		case 'notifications/view' 	       : $fileToLoad = 'Unotifview.php'; break;
		case 'notifications/add/form-data' : $fileToLoad = 'UnotifcreateHandler.php'; break;
		case 'log' 					       : $fileToLoad = 'URecordPg.php'; break;
		case 'log/add' 				       : $fileToLoad = 'UWorkLogForm.php'; break;
		case 'log/add/form-data' 	       : $fileToLoad = 'UWorkLogHandler.php'; break;
		case 'absences' 			       : $fileToLoad = 'UAbsencePg.php'; break;
		case 'login' 			           : $fileToLoad = 'ULoginForm.php'; break;
	}

	if (!file_exists($fileToLoad)) {
		ob_clean();
		header('Location: ?action=notifications');
		exit;
	}

	require $fileToLoad;
