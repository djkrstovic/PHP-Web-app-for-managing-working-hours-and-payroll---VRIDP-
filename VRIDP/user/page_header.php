<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <script>
            setTimeout(function(){
                document.querySelector('.alert').style.display = 'none';
            }, 5000);
        </script>
    </head>
    
    <body>
        <div id="sredina">
            
            <div id="header">
                <ul>
                    <li><a href="?action=notifications">Obaveštenja</a>
                    <li><a href="?action=log">Evidencija</a>
                    <li><a href="?action=absences">Odsustva</a>
                    <li class="dropdown">
                        <a href="" class="dropbtn">Statistika</a>
                        <div class="dropdown-content">
                          <a href="?action=report/yearly-totals">Godišnje isplate</a>
                          <a href="?action=report/yearly-hours">Godišnji sati</a>
                          <a href="?action=report/yearly-hours-global">Ukupno odrađeni sati / odsustva</a>
                        </div>
                    <li style="float:right"><a href="../logout.php">Log Out</a>
                </ul>
            </div>
            
            <div id="sadrzaj">
