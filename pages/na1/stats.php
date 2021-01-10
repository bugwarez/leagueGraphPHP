<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summoner Stats</title>
</head>
<body>
<?php
$summoner_name = $_GET["summoner_name"];
$summoner_server = $_GET["summoner_server"];
//! Data URL'S
//? get summoner
$get_summoner_url = "https://tr1.api.riotgames.com/lol/summoner/v4/summoners/by-name/$summoner_name";
$get_summoner_json = file_get_contents("$get_summoner_url");
$get_summoner_obj = json_decode($get_summoner_json);
echo " testttt";
echo $get_summoner_obj->id;
?>
<?php include "./config/db.php" ?>
<?php include "./components/navbar.php" ?>
<?php
echo "name is:" . $summoner_name . "<br>";

echo "-----url : " . $get_summoner_url;
?>
</body>
</html>