<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

    require '../DataBaseConnection.php';

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $sql = 'SELECT * FROM manager_notification WHERE manager_notification_id = ?;';
    $prep = $db->prepare($sql);
    $res = $prep->execute([$id]);
    $error = '';
    $item = null;
    if (!$res) {
        $error = 'Ne postoji trazeno obavestenje!';
    } else {
        $item = $prep->fetch(PDO::FETCH_OBJ);
        if (!$item) {
            $error = 'Ne postoji trazeno obavestenje!';
        }
    }

    require 'page_header.php';
	
?>
			<title> Pregled obaveštenja </title>
            
            <div id="sadrzaj">
                <div class="izgledforme3">
                    <?php if ($error): ?>
                    <br><br><p>Greska: <?php echo $error; ?></p>
                    <?php else: ?>
                        <h2 align="left">[<?php echo htmlspecialchars($item->tag); ?>] <?php echo htmlspecialchars($item->subject); ?></h2>
                        <p align="left"><?php echo nl2br(htmlspecialchars($item->message)); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        
                
                  
<?php require 'page_footer.php'; ?>
