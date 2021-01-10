<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeagueStats</title>
</head>
<?php

if (isset($_POST['summoner_name'])) {
    $summoner_name = $_POST["summoner_name"];
    $server = $_POST["summoner_server"];
    header("Location: $url/pages/$server/stats.php?summoner_name=$summoner_name");
}
?>
<body>
    <?php include "./config/db.php" ?>
    <?php include "./components/navbar.php" ?>
    <div class="alert alert-success text-center p-2" role="alert">
        ♥ This Website is Under Maintenance ♥
    </div>
    <div class="container text-center">
        <div class="row mt-5">
        
            <div class="col-sm">
                <!--  -->
            </div>
            <div class="col-sm">
            <?php
            echo"
            <form method='POST' action=''>
            <div class='input-group mb-3'>
                <input type='text' name='summoner_name' class='form-control' placeholder='Username'
                 aria-label='Username' aria-describedby='basic-addon1'>
                    <select required name='summoner_server' class='form-select' id='summoner_server'>
                        <option disabled muted selected value=''>Server</option>
                        <option value='tr1'>TR</option>
                        <option value='euw1'>EUW</option>
                        <option value='na1'>NA</option>
                    </select>
                 
            </div>
            <button type='submit'>Show My Stats</button>
        </form>
                ";
                echo "test" . $summoner_name;
                ?>
            </div>
            <div class="col-sm">
                <!--  -->
            </div>
        </div>
    </div>
    <!-- Scripts -->
</body>

</html>