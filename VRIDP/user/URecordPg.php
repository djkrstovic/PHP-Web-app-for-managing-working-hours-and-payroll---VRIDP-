<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

    require '../DataBaseConnection.php';

    require 'page_header.php';
	
	$sql = 'SELECT COUNT(work_log.work_log_id) AS c
			FROM work_log
			WHERE work_log.hours_worked != 0;';
	$prep = $db->prepare($sql);
    $res = $prep->execute();
	$data = $prep->fetch(PDO::FETCH_OBJ);
	$totalCount = intval($data->c);
	
	$page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
	$count = 10;
	
	$pageCount = floor($totalCount / $count);

	$from = $page * $count;

	$sql = 'SELECT work_log.*, employee.*
			FROM work_log
			INNER JOIN employee ON work_log.employee_id = employee.employee_id
			WHERE
				work_log.hours_worked != 0
			ORDER BY
				work_log.created_at DESC
			LIMIT ' . $from . ', ' . $count . ';';
	$prep = $db->prepare($sql);
    $res = $prep->execute();
	$lista = [];
	if ($res) {
		$lista = $prep->fetchAll(PDO::FETCH_OBJ);
	}
	
	function lepDatum($isoDatum) {
		return date('j. n. Y. H.i', strtotime($isoDatum));
	}
	
	$meseciImena = ['Januar', 'Februar', 'Mart', 'April', 'Maj', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar'];

	$message = '';

	if (isset($_GET['message'])) {
		$messageId = filter_input(INPUT_GET, 'message', FILTER_SANITIZE_NUMBER_INT);

		switch ($messageId) {
			case 0: $message = 'Došlo je do greške. Probajte ponovo! :('; break;
			case 1: $message = 'Uspešno je evidentirano.'; break;
		}
	}
?>
        <title> Evidencija </title>
        <div id="sadrzaj">
                <div id="notiftable">
                    <h2>Evidencija</h2>

					<?php if ($message): ?>
					<div class="alert">
						<?php echo htmlspecialchars($message); ?>
					</div>
					<?php endif; ?>
					
                        <table>
							<thead>
								<tr>
									<th>Datum
									<th>Ime
									<th>Prezime
									<th>Mesec
									<th>Sati
									<th>Cena
									<th>Plata
									<th>JMBG
							<tbody>
							<?php foreach ($lista as $item): ?>
								<tr>
									<td><?php echo lepDatum($item->created_at); ?>
									<td><?php echo $item->forename; ?>
									<td><?php echo $item->surname; ?>
									<td><?php echo $meseciImena[$item->month-1]; ?>
									<td><?php echo $item->hours_worked; ?>
									<td><?php echo $item->hours_price; ?>
									<td><?php echo $item->hours_worked * $item->hours_price + $item->hours_absent_paid * $item->hours_absent_price; ?>
									<td><?php echo $item->jmbg; ?>
							<?php endforeach; ?>
							<tfoot>
								<tr>
									<td colspan="8" class="text-align-center">
										<?php if ($page > 1): ?>
										<a class="paginacija-link" href="?action=log&page=<?php echo $page-2; ?>">
											<?php echo $page-1; ?>
										</a>
										<?php endif; ?>

										<?php if ($page > 0): ?>
										<a class="paginacija-link" href="?action=log&page=<?php echo $page-1; ?>">
											<?php echo $page; ?>
										</a>
										<?php endif; ?>
										
										<span class="paginacija-link current"><?php echo $page+1; ?></span>
										
										<?php if ($page+1 < $pageCount): ?>
										<a class="paginacija-link" href="?action=log&page=<?php echo $page+1; ?>">
											<?php echo $page+2; ?>
										</a>
										<?php endif; ?>
										
										<?php if ($page+2 < $pageCount): ?>
										<a class="paginacija-link" href="?action=log&page=<?php echo $page+2; ?>">
											<?php echo $page+3; ?>
										</a>
										<?php endif; ?>
                        </table>
                    <a href="?action=log/add"><input type="submit" class="dugmeO" value="Dodaj"></a>
                    </div>
        
<?php require 'page_footer.php'; ?>