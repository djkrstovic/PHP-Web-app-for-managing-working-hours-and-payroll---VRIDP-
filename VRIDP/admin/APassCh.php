<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }

    require 'admin-session-check.php';

    require '../DataBaseConnection.php';
    require 'Aheader.php'

    $managerId = filter_input(INPUT_GET, 'manager_id', FILTER_SANITIZE_NUMBER_INT);
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

    $message = '';

	if (isset($_GET['message'])) {
		$messageId = filter_input(INPUT_GET, 'message', FILTER_SANITIZE_NUMBER_INT);

		switch ($messageId) {
			case 0: $message = 'Došlo je do greške. Probajte ponovo! :('; break;
			case 1: $message = 'Lozinke nisu iste.'; break;
			case 2: $message = 'Lozinka mora biti najmanje 6 karaktere duzine.'; break;
			case 3: $message = 'Sve je u redu.'; break;
		}
	}
?>
                <div id="passch">

                    <?php if ($message): ?>
                    <div class="alert">
	                    <?php echo htmlspecialchars($message); ?>
                    </div>
                    <?php endif; ?>

                    <form id="forme" method="post" action="?action=change-password/handle">
                        <p>Promena lozinke za mnedzera: <?php echo htmlspecialchars($manager->forename . ' ' . $manager->surname); ?></p>
                        <input name="manager_id" type="hidden" value="<?php echo $managerId; ?>">
                        <input name="pass1" type="password" class="izgledforme4" placeholder="Lozinka" required><br/><br/>
                        <input name="pass2" type="password" class="izgledforme4" placeholder="Ponovi lozinku" required><br/><br/><br/>
                        <input type="submit" class="dugme" value="Sačuvaj">
                    </form>
                </div>


<?php
            require 'AFooter.php'
?>