<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }
    
    require '../DataBaseConnection.php';
    require 'admin-session-check.php';

    require 'Aheader.php'
?>
                <div id="passch">
                    <form id="forme" method="post" action="#">
                        <input name="aime" type="text" class="izgledforme4" placeholder="Ime" required><br/><br/>
                        <input name="aprezime" type="text" class="izgledforme4" placeholder="Prezime" required><br/><br/><br/>
                        <input name="korisnickoime" type="text" class="izgledforme4" placeholder="Korisnicko ime" required><br/><br/>
                        <input name="pass1" type="password" class="izgledforme4" placeholder="Lozinka" required><br/><br/>
                        <input name="pass2" type="password" class="izgledforme4" placeholder="Ponovi lozinku" required><br/><br/><br/>
                        <input type="submit" class="dugme" value="Kreiraj">
                    </form>
                </div>
                


<?php
            require 'AFooter.php'
        
?>
