<?php
    if (!defined('VALID_ENTRY')) {
        die('Ilegalan pristup. Prijavicemo Vasu IP adresu policiji!');
    }
    
    require '../DataBaseConnection.php';
    require 'admin-session-check.php';

    require 'Aheader.php'
?>
                <div id="notiftable">
                    <h2>Obaveštenja</h2>
                            <a href="Anotifcreate.html"><input type="submit" id="inline" class="dugmeC" value="Dodaj"></a>

                        <table>
                          <tr>
                            <th>Vreme</th>
                            <th>Naslov</th>
                            <th>Obaveštenje</th>
                            <th>Administrator</th>
                            <th>Arhivirano</th>
                            <th width="2%"></th>
                            <th width="2%"></th>
                          </tr>
                          <tr>
                            <td>10/26/2018 12:41pm</td>
                            <td>Problem</td>
                            <td>Tekst dodje...</td>
                            <td>djordjedavid</td>
                            <td>Da</td>
                            <td><a href="Anotifview.html" ><i class="fa fa-eye"></i></a></td>
                            <td><a href="#" ><i class="fa fa-archive"></i></a></td> <!-- dugme ili link? za arhiviranje -->
                          </tr>
                          <tr>
                            <td>10/26/2018 12:41pm</td>
                            <td>Problem</td>
                            <td>Tekst dodje...</td>
                            <td>djordjedavid</td>
                            <td>Da</td>
                            <td><a href="#" ><i class="fa fa-eye"></i></a></td>
                            <td><a href="#" ><i class="fa fa-archive"></i></a></td>
                          </tr>
                          <tr>
                            <td>10/26/2018 12:41pm</td>
                            <td>Problem</td>
                            <td>Tekst dodje...</td>
                            <td>djordjedavid</td>
                            <td>Ne</td>
                            <td><a href="#" ><i class="fa fa-eye"></i></a></td>
                            <td><a href="#" ><i class="fa fa-archive"></i></a></td>
                          </tr>
                          <tr>
                            <td>10/26/2018 12:41pm</td>
                            <td>Problem</td>
                            <td>Tekst dodje...</td>
                            <td>djordjedavid</td>
                            <td>Da</td>
                            <td><a href="#" ><i class="fa fa-eye"></i></a></td>
                            <td><a href="#" ><i class="fa fa-archive"></i></a></td>
                          </tr>
                          <tr>
                            <td>10/26/2018 12:41pm</td>
                            <td>Problem</td>
                            <td>Tekst dodje...</td>
                            <td>djordjedavid</td>
                            <td>Ne</td>
                            <td><a href="#" ><i class="fa fa-eye"></i></a></td>
                            <td><a href="#" ><i class="fa fa-archive"></i></a></td>
                          </tr>
                        </table>
                            <a href="#"><input type="submit" id="inline" class="dugmeA" value="Arhiva"></a>
                </div>
<?php
            require 'AFooter.php'
        
?>
