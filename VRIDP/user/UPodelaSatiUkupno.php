<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

	require '../DataBaseConnection.php';
	
	$sql = 'SELECT
	            SUM(work_log.hours_worked) AS ukupno_sati_rada,
	            SUM(work_log.hours_absent_paid) AS ukupno_palcenih_sati,
	            SUM(work_log.hours_absent_unpaid) AS ukupno_neplacenih_sati
            FROM
	            work_log;';
    $prep = $db->prepare($sql);
    $res = $prep->execute();
	$podaci = $prep->fetch(PDO::FETCH_OBJ);
	
	$lista = json_encode(['Broj odradjenih sati', 'Sati placenog odsustva', 'Sati neplacenog odsustva']);
    $iznosi = json_encode([
        $podaci->ukupno_sati_rada,
        $podaci->ukupno_palcenih_sati,
        $podaci->ukupno_neplacenih_sati
    ]);

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
		type: 'pie',
		data: {
			labels: <?php echo $lista; ?>,
			datasets: [{
				label: 'Podela broja sati rada/placenog i neplacenog odsustva za sve vreme vodjenja evidencije',
				data:  <?php echo $iznosi; ?>,
				backgroundColor: ['#1400ff', '#c90002', '#9d0bb7']
			}],
		},
		options: {
		}
	});
</script>
<?php require 'page_footer.php';
