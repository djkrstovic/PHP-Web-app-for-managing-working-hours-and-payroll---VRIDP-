<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

	require '../DataBaseConnection.php';
	
	$sql = 'SELECT
	            `year`,
	            SUM(work_log.hours_worked) AS ukupno_sati_rada,
	            SUM(work_log.hours_absent_paid) AS ukupno_palcenih_sati,
	            SUM(work_log.hours_absent_unpaid) AS ukupno_neplacenih_sati
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
	$odradjeni = [];
	$placeni = [];
	$neplaceni = [];
	
	foreach ($podaci as $podatak) {
		$lista[$podatak->year] = $podatak;

        $odradjeni[$podatak->year] = $podatak->ukupno_sati_rada;
        $placeni[$podatak->year]   = $podatak->ukupno_palcenih_sati;
        $neplaceni[$podatak->year] = $podatak->ukupno_neplacenih_sati;
	}

/*print_r(
[
    array_keys($lista),
    array_values($odradjeni),
    array_values($placeni),
    array_values($neplaceni)
]
);*/
	
	$godine = json_encode(array_keys($lista));
	$odradjeni = json_encode(array_values($odradjeni));
	$placeni = json_encode(array_values($placeni));
	$neplaceni = json_encode(array_values($neplaceni));

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
		type: 'horizontalBar',
		data: {
			labels: <?php echo $godine; ?>,
			datasets: [
                {
				    label: 'Odradjeni sati',
				    data:  <?php echo $odradjeni; ?>,
				    backgroundColor: '#009dff'
			    },
                {
				    label: 'Placeni sati odsustva',
				    data:  <?php echo $placeni; ?>,
				    backgroundColor: '#ff6c00'
			    },
                {
				    label: 'Neplaceni sati odsustva',
				    data:  <?php echo $neplaceni; ?>,
				    backgroundColor: '#ff0003'
			    }
            ],
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
