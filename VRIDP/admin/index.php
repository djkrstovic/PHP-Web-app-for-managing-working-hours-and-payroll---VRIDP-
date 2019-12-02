<?php
    define('VALID_ENTRY', TRUE);

	$action = trim(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING));
	
	if ($action == '') {
		$action = 'notifications';
	}

	$fileToLoad = '';

	switch ($action) {
		case 'notifications' 		  : $fileToLoad = 'ANotifPg.php'; break;
		case 'notifications/add' 	  : $fileToLoad = 'Anotifcreate.php'; break;
		case 'log' 					  : $fileToLoad = 'ARecordPg.php'; break;
		case 'log/add' 				  : $fileToLoad = 'AWorkLogForm.php'; break;
		case 'absences' 			  : $fileToLoad = 'AAbsencePg.php'; break;
		case 'login' 			      : $fileToLoad = 'ALoginForm.php'; break;
		case 'users/new' 		      : $fileToLoad = 'ANewUs.php'; break;
		case 'users' 		          : $fileToLoad = 'AUserPg.php'; break;
		case 'change-password'        : $fileToLoad = 'APassCh.php'; break;
		case 'change-password/handle' : $fileToLoad = 'APassChHandler.php'; break;
	}

	if (!file_exists($fileToLoad)) {
		ob_clean();
		header('Location: ?action=notifications');
		exit;
	}

	require $fileToLoad;
