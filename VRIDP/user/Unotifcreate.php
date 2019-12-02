<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavićemo Vašu IP adresu policiji!');
    }

    require 'user-session-check.php';

    require '../DataBaseConnection.php';

    require 'page_header.php';
	
?>
			<title> Kreiranje obaveštenja </title>
            <div id="sadrzaj">
                <div class="forme">
                    <form id="forme" method="post" action="?action=notifications/add/form-data">
                        <input name="subject" type="text" class="izgledforme" placeholder="Naslov obaveštenja" required><br/>
                        <div id="sektor">
                            <select name="tag">
                                <option value="prodaja" name="dropdown">Sektor prodaje</option>
                                <option value="proizvodnja" name="dropdown">Sektor proizvodnje</option>
                                <option value="finansije" name="dropdown">Sektor finansija</option>
                                <option value="marketing" name="dropdown">Sektor marketinga</option>
                                <option value="podrska" name="dropdown">Sektor tehničke podrške</option>
                            </select>
                        </div><br/><br/>                                      
                        <textarea name="message" class="izgledforme2" placeholder="Unesite tekst obaveštenja" rows="7" required></textarea><br/>
                        <input type="submit" class="dugme" value="Pošalji">
                    </form>
                </div>
        
                
            
<?php require 'page_footer.php'; ?>
