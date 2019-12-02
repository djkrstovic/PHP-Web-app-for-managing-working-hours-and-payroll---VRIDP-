<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }
    
    require '../DataBaseConnection.php';
    require 'admin-session-check.php';

    require 'Aheader.php'
?>
                <div id="notiftable">
                    <h2>Evidencija</h2>

                        <table>
                            <tr>
                                <th>Datum</th>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Mesec</th>
                                <th>Radni sati</th>
                                <th>Satnica</th>
                                <th>JMBG</th>
                                <th>korisnik_id</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>10/26/2018 12:41pm</td>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>Januar</td>
                                <td>200</td>
                                <td>200RSD</td>
                                <td>1212992740046</td>
                                <td>Poslovodja 1</td>
                                <td><i class="fa fa-print" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td>10/26/2018 12:41pm</td>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>Januar</td>
                                <td>200</td>
                                <td>200RSD</td>
                                <td>1212992740046</td>
                                <td>Poslovodja 1</td>
                                <td><i class="fa fa-print" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td>10/26/2018 12:41pm</td>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>Januar</td>
                                <td>200</td>
                                <td>200RSD</td>
                                <td>1212992740046</td>
                                <td>Poslovodja 1</td>
                                <td><i class="fa fa-print" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td>10/26/2018 12:41pm</td>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>Januar</td>
                                <td>200</td>
                                <td>200RSD</td>
                                <td>1212992740046</td>
                                <td>Poslovodja 1</td>
                                <td><i class="fa fa-print" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td>10/26/2018 12:41pm</td>
                                <td>Milos</td>
                                <td>Milosevic</td>
                                <td>Januar</td>
                                <td>200</td>
                                <td>200RSD</td>
                                <td>1212992740046</td>
                                <td>Poslovodja 1</td>
                                <td><i class="fa fa-print" aria-hidden="true"></i></td>
                            </tr>
                    </table>
                    </div>

<?php
            require 'AFooter.php'
        
?>