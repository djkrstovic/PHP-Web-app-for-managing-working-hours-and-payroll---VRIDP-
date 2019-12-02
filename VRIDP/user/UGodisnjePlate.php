<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

	require '../DataBaseConnection.php';
	
	$sql = 'SELECT
				`year`,
				SUM(hours_worked * hours_price) suma_plata
			FROM
				work_log
			GROUP BY
				`year`
			ORDER BY
				`year`;';
    $prep = $db->prepare($sql);
    $res = $prep->execute();
	$podaci = $prep->fetchAll(PDO::FETCH_OBJ);
	
	$lista = [];
	
	foreach ($podaci as $podatak) {
		$lista[$podatak->year] = $podatak->suma_plata;
	}
	
	$godine = json_encode(array_keys($lista));
	$iznosi = json_encode(array_values($lista));

    require 'page_header.php';
?>
<title> Izveštaj o godišnjim ukupnim isplatama na račun plaćenog rada </title>
<div id="passch">
	<canvas id="izvestaj" width="700" height="300"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>

<script>
	var ctx = document.getElementById("izvestaj").getContext('2d');
	var izvestaj = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?php echo $godine; ?>,
			datasets: [{
				label: 'Godišnje ukupne isplate na račun plaćenog rada',
				data:  <?php echo $iznosi; ?>,
				backgroundColor: '#0080ff'
			}],
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>
<?php require 'page_footer.php';
