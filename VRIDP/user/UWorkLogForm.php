<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

	require '../DataBaseConnection.php';
	
	$sql = 'SELECT * FROM employee ORDER BY forename, surname, jmbg;';
    $prep = $db->prepare($sql);
    $res = $prep->execute();
	$zaposleni = $prep->fetchAll(PDO::FETCH_OBJ);

    $godine = [
        date('Y') - 1,
        date('Y'),
        date('Y') + 1
    ];

    $meseci = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $meseciImena = ['Januar', 'Februar', 'Mart', 'April', 'Maj', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar'];

	$message = '';

	if (isset($_GET['message'])) {
		$messageId = filter_input(INPUT_GET, 'message', FILTER_SANITIZE_NUMBER_INT);

		switch ($messageId) {
			case 0: $message = 'Došlo je do greške. Probajte ponovo! :('; break;
			case 1: $message = 'Uspešno je evidentirano.'; break;
		}
	}
	
    require 'page_header.php';
?>
<title> Dodavanje u evidenciju </title>
<div id="passch">
	<?php if ($message): ?>
	<div class="alert">
		<?php echo htmlspecialchars($message); ?>
	</div>
	<?php endif; ?>
    <form id="forme" method="post" action="?action=log/add/form-data">
		<datalist id="zaposleni">
			<?php foreach ($zaposleni as $zap): ?>
            <option value="<?php echo $zap->forename . ' ' . $zap->surname . ' ' . $zap->jmbg; ?>">
			<?php endforeach; ?>
		</datalist>
		<input name="zaposleni_full_data" type="text" class="izgledforme4" required list="zaposleni"><br><br>
        <!-- <input name="aime" type="text" class="izgledforme4" placeholder="Ime" required><br><br>
        <input name="aprezime" type="text" class="izgledforme4" placeholder="Prezime" required><br><br><br> -->
        <select name="godina" class="izgledforme4">
            <?php foreach ($godine as $godina): ?>
            <option value="<?php echo $godina; ?>" <?php if ($godina == date('Y')) echo 'selected'; ?>>
                <?php echo $godina; ?>.
            </option>
            <?php endforeach; ?>
        </select><br><br>
        <select name="mesec" class="izgledforme4">
            <?php foreach ($meseci as $mesec): ?>
            <option value="<?php echo $mesec; ?>" <?php if ($mesec == date('m')) echo 'selected'; ?>>
                <?php echo $meseciImena[$mesec-1]; ?>
            </option>
            <?php endforeach; ?>
        </select><br><br>
        <input name="rsati" type="number" min="0" step="1" class="izgledforme4" placeholder="Radni sati" required><br><br>
        <input name="satnica" type="number" step="0.01" class="izgledforme4" placeholder="Satnica(RSD)" required><br><br>
        <input name="sati_odsutan" type="number" min="0" step="1" class="izgledforme4" placeholder="Sati odsutan(plaćeno)" required><br><br>
        <input name="satnica_odsutan" type="number" step="0.01" class="izgledforme4" placeholder="Satnica odsutan(RSD)" required><br><br>
        <input name="sati_neplaceno" type="number" step="1" class="izgledforme4" placeholder="Sati neplaćeno" required><br><br><br>
        <!-- <input name="jmbg" type="text" pattern="^[0-9]{13}$" maxlength="13" class="izgledforme4" placeholder="JMBG" required><br><br> -->
        <input type="submit" name="nacin_dodavanja" class="dugmeDodaj" value="Evidentiraj i dodaj još">
        <input type="submit" name="nacin_dodavanja" class="dugmeDodaj" value="Evidentiraj i otvori listu">
    </form>
</div>
<?php require 'page_footer.php';
