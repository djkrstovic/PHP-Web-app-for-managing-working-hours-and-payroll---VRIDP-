<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }
    
    require '../DataBaseConnection.php';
    require 'admin-session-check.php';

    require 'Aheader.php'
?>
                <div class="forme">
                    <form id="forme" method="post" action="#">
                        <input name="naslov" type="text" class="izgledforme" placeholder="Naslov obaveštenja" required><br/>
                        <textarea name="poruka" class="izgledforme2" placeholder="Unesite tekst obaveštenja" rows="7" required></textarea><br/>
                        <input type="submit" class="dugme" value="Pošalji">
                    </form>
                </div>
        
                
<?php
            require 'AFooter.php'
        
?>
