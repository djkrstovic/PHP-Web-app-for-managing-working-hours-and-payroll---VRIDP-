 <link rel="stylesheet" href="../css/style.css">
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

    $subject   = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $tag       = filter_input(INPUT_POST, 'tag',     FILTER_SANITIZE_STRING);
    $message   = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (!in_array($tag, ['prodaja', 'proizvodnja', 'finansije', 'marketing', 'podrska'])) {
        $message = "<div id='msg-sql'><p>Nije ispravan sektor!</p></div>";
    } else {
        $managerId = $_SESSION['manager_id'];
    
	    $sql = 'INSERT manager_notification SET
				    manager_id = ?,
				    subject = ?,
				    message = ?,
				    tag = ?;';

	    $prep = $db->prepare($sql);
	    $res = $prep->execute([
		    $managerId,
		    $subject,
		    $message,
		    $tag
	    ]);

	    if ($res) {
		    $message = "<div id='msg-sql'><p>Uspešno je evidentirano!</p></div>";
	    } else {
		    $message = "<div id='msg-sql'><p>Došlo je do greške. Probajte ponovo!</p></div>";
	    }
    }

    echo $message;
?>
<a href="javascript:window.history.go(-1);"><input type="button" class="nazad" value="Nazad"></a>
