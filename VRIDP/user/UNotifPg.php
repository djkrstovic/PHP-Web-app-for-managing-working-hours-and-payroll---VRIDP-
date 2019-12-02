<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

    require '../DataBaseConnection.php';

    require 'page_header.php';

    $isArchived = 0;
    if (isset($_GET['archive'])) {
        $isArchived = 1;
    }

    $sql = "SELECT
                manager_notification.*,
                manager.*
            FROM
                manager_notification
                INNER JOIN manager ON manager_notification.manager_id = manager.manager_id
            WHERE
                is_archived = {$isArchived}
            ORDER BY
                created_at DESC;";
    $prep = $db->prepare($sql);
    $res = $prep->execute();
    $lista = [];
    if ($res) {
        $lista = $prep->fetchAll(PDO::FETCH_OBJ);
    }
	
?>

			<title> Obaveštenja - <?php if ($isArchived) echo 'Arhivirana'; else echo 'Nearhivirana'; ?></title>
            <div id="sadrzaj">
                <div id="notiftable">
                    <h2>Obaveštenja - <?php if ($isArchived) echo 'Arhivirana'; else echo 'Nearhivirana'; ?></h2>
                            <a href="?action=notifications/add"><input type="submit" id="inline" class="dugmeC" value="Dodaj"></a>

                        <table>
                          <tr>
                            <th>Datum</th>
                            <th>Korisnik</th>
                            <th>Naslov</th>
                            <th>Sadržaj</th>
                            <th>Sektor</th>
                            <th width="2%"></th>
                          </tr>
                            <?php foreach ($lista as $item): ?>
                            <tr>
                                <td><?php echo date('j. n. Y. H.i', strtotime($item->created_at)); ?>
                                <td><?php echo $item->email; ?>
                                <td><?php echo htmlspecialchars($item->subject); ?>
                                <td><?php echo htmlspecialchars(substr($item->message, 0, 30). '...'); ?>
                                <td><?php echo htmlspecialchars($item->tag); ?>
                                <td><a href="?action=notifications/view&id=<?php echo $item->manager_notification_id; ?>"><i class="fa fa-eye"></i></a></td>
                            <?php endforeach; ?>
                          
                        </table>
                        <?php if ($isArchived == 0): ?>
                        <br><a href="?action=notifications&archive" class="button">Arhivirani</a>
                        <?php else: ?>
                        <br><a href="?action=notifications" class="button">Nearhivirani</a>
                        <?php endif; ?>
                </div>
            
<?php require 'page_footer.php'; ?>
