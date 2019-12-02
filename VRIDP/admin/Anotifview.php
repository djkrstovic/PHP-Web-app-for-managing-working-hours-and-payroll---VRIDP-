<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }
    
    require '../DataBaseConnection.php';
    require 'admin-session-check.php';

    require 'Aheader.php'
?>
                <div class="izgledforme3">
                        <h2 align="left">Naslov</h2>
                        <p align="left">Tekst poruke</p>
                        <input type="submit" class="dugme1" value="Arhiviraj">
                </div>
        

<?php
            require 'AFooter.php'
        
?>
