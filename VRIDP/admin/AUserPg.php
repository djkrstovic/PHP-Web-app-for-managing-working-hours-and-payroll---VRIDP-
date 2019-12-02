<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }
    
    require '../DataBaseConnection.php';
    require 'admin-session-check.php';

    require 'Aheader.php'
?>
                <div id="notiftable">
                    <h2>Korisnici</h2>

                            <a href="ANewUs.html"><input type="submit" id="inline" class="dugmeC" value="Dodaj"></a>
                        <table>
                            <tr>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Korisničko ime</th>
                                <th width="10%">Promena lozinke</th>
                                <th width="5%">Status</th>
                            </tr>
                            <tr>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>poslovodja 1</td>
                                <td><a href="?action=change-password"><i class="fa fa-key"></i></a></td>
                                <td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                            </tr>
                            <tr>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>poslovodja 1</td>
                                <td><a href="index.php?action=change-password&manager_id=2"><i class="fa fa-key"></i></a></td>
                                <td><a href="#"><i class="fa fa-check" aria-hidden="true"></i></a></td>
                            </tr>
                            <tr>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>poslovodja 1</td>
                                <td><a href="APassCh.html"><i class="fa fa-key"></i></a></td>
                                <td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                            </tr>
                            <tr>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>poslovodja 1</td>
                                <td><a href="APassCh.html"><i class="fa fa-key"></i></a></td>
                                <td><a href="#"><i class="fa fa-check" aria-hidden="true"></i></a></td>
                            </tr>
                            <tr>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>poslovodja 1</td>
                                <td><a href="APassCh.html"><i class="fa fa-key"></i></a></td>
                                <td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                            </tr>
                            <tr>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>poslovodja 1</td>
                                <td><a href="APassCh.html"><i class="fa fa-key"></i></a></td>
                                <td><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                            </tr>
                    </table>
                    </div>
                

<?php
            require 'AFooter.php'
        
?>