<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

    require '../DataBaseConnection.php';

    require 'page_header.php';

	$sql = 'SELECT work_log.*, employee.*
				FROM work_log
				INNER JOIN employee ON work_log.employee_id = employee.employee_id
				WHERE
					work_log.hours_absent_paid > 0
					OR work_log.hours_absent_unpaid > 0
				ORDER BY
					work_log.created_at DESC;';
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
?>

        <title> Odsustva </title>
        <div id="sadrzaj">
                <div id="notiftable">
                    <h2>Odsustva</h2>

                        <table>
                            <tr>
                                <th>Datum</th>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Mesec</th>
                                <th>PS</th>
                                <th>NS</th>
                                <th>PO</th>
                                <th>JMBG</th>
                            </tr>
							<?php foreach ($lista as $item): ?>
							<tr>
                                <td><?php echo lepDatum($item->created_at); ?>
                                <td><?php echo $item->forename; ?>
                                <td><?php echo $item->surname; ?>
                                <td><?php echo $meseciImena[$item->month-1]; ?>
                                <td><?php echo $item->hours_absent_paid; ?>
                                <td><?php echo $item->hours_absent_unpaid; ?>
                                <td><?php echo $item->hours_absent_paid * $item->hours_absent_price; ?>
                                <td><?php echo $item->jmbg; ?>
                            </tr>
							<?php endforeach; ?>
                        </table>
                    <a href="?action=log/add"><input type="submit" class="dugmeO" value="Dodaj"></a>
                    </div>
<?php require 'page_footer.php'; ?>