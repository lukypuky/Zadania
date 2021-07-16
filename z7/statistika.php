<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Zadanie7 - Lukáš Bača</title>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB1DxmfAu1o21iePrB6tTZ85REY17Htjw"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <header>
        <nav>
            <div class="buttons">
                <a href="index.php" class="menu">Počasie</a>
                <a href="userInfo.php" class="menu">Poloha</a>
                <a href="statistika.php" class="menu">Štatistika</a>
            </div>
            <h1 class="heading">Štatistika</h1>
        </nav>
    </header>

    <body>
        <div id="nepotvrdene" style="display: none">
            <p>Bohužiaľ, pre sprístupnenie stránky je potrebné potvrdiť spracovanie IP adresy a GPS súradníc.</p>
        </div>

        <div class="container">
            <div>
                <div id="vypisTabulku"></div>
            </div>

            <div id="id01" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>

                        <div id="prehlad"></div>

                        <div id="map" style="width: 45vw; height: 30vw "></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="script.js"></script>

        <?php
            require 'config.php';

            $sql = "INSERT INTO webvisits (type) VALUES ('statistics')";
            $stm = $connect->query($sql);
        ?>
    </body>

    <footer>
        <div class="right">
            © Lukáš Bača
        </div>
    </footer>
</html>