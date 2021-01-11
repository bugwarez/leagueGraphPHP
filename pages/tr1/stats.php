<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <title>Summoner Stats</title>
</head>

<body>
    <?php include "../../config/config.php" ?>
    <?php include "../../components/navbar.php" ?>
    <?php
    //!Variables
    $summoner_name = $_GET["summoner_name"];
    $summoner_server = $_GET["summoner_server"];
    //! Data URL'S
    //? get summoner
    $get_summoner_url = "https://tr1.api.riotgames.com/lol/summoner/v4/summoners/by-name/$summoner_name?api_key=$api_key";
    $get_summoner_json = file_get_contents("$get_summoner_url");
    $get_summoner_obj = json_decode($get_summoner_json);
    //?--end get summoner
    //!------------
    //*---get Champs
    $get_champs = "http://ddragon.leagueoflegends.com/cdn/11.1.1/data/en_US/champion.json";
    $get_champs_json = file_get_contents("$get_champs");
    $get_champs_obj = json_decode($get_champs_json, true);
    //*----END Champs
    //!------------
    //*---get summoner match history
    $account_id = $get_summoner_obj->accountId;
    $get_summoner_matches_url = "https://tr1.api.riotgames.com/lol/match/v4/matchlists/by-account/$get_summoner_obj->accountId?api_key=$api_key";
    $get_summoner_matches_json = file_get_contents("$get_summoner_matches_url");
    $get_summoner_matches_obj = json_decode($get_summoner_matches_json, true);
    //*----END GET SUMMONER MATCH HISTORY
    //!------------

    //?----get summoner League
    //NOTE:DONT FORGET TO ADD API KEY


    ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-2">
                <?php echo "<img class='summoner_icon' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/profileicon/$get_summoner_obj->profileIconId.png' class='img-fluid' alt='LeagueIcon'>"; ?>

                <div class="row">
                    <div class="col-sm">
                        <?php echo "<h4 class='text-left pt-2'><span class='badge badge_text alert-primary'>$get_summoner_obj->name - $get_summoner_obj->summonerLevel</span></h4>" ?>
                    </div>
                </div>
            </div>
            <div style="margin-left: 2vw !important;" class="col-9 p-0 m-0">
                <div class="card summoner_league_card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row text-center">
                                <!-- //TODO:Show Unranked icon if user has no leagueS -->
                                <div class="col-sm">
                                    <img src="/assets/images/tier_emblems/Emblem_Bronze.png" class="img-fluid summoner_rank" alt="Responsive image">
                                </div>
                                <div class="col-sm">
                                    <img src="/assets/images/tier_emblems/Emblem_Silver.png" class="img-fluid summoner_rank" alt="Responsive image">
                                </div>
                                <div class="col-sm">
                                    <img src="/assets/images/tier_emblems/Emblem_Gold.png" class="img-fluid summoner_rank" alt="Responsive image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-3">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-body">
                            <h5>Son 10 Maç İstatistiği</h5>
                            <!-- //TODO:WIN/LOSE RATE in "Drilldown" chart -->
                            <!-- //TODO:DONT FORGET TO PUSH UPDATED CODE TO GITHUB -->
                            <!-- //TODO:When this project finish, go for faceit style custom matchmaking and ranking website -->
                            <?php

                            foreach (array_slice($get_summoner_matches_obj["matches"], 0, 10) as $summoner_matches_data) {
                                echo "
                            <div class='card mb-3'><!-- FOREACH START -->
                                <div class='row'>
                                    <div class='col-md-2 py-2'>
                                    ";
                                foreach ($get_champs_obj['data'] as $champion) {
                                    if ($champion['key'] == $summoner_matches_data['champion']) {
                                        echo "<img loading='lazy' style='width: 8.3vw;margin-left: 2vw;'
                                                src='http://ddragon.leagueoflegends.com/cdn/img/champion/loading/$champion[id]_0.jpg' class='card-img' alt='...'>";
                                        break;
                                    }
                                }
                                //! $summoner_matches_data[gameId]

                                //!------------
                                //*---get summoner match data

                                $get_summoner_match_data_url = "https://tr1.api.riotgames.com/lol/match/v4/matches/$summoner_matches_data[gameId]?api_key=$api_key";
                                $get_summoner_match_data_json = file_get_contents("$get_summoner_match_data_url");
                                $get_summoner_match_data_obj = json_decode($get_summoner_match_data_json, true);
                                //*----END GET SUMMONER MATCH DATA
                                //!------------

                                //TODO: GET MATCH DATA.
                                //TODO: MATCH INGAME DATA JSON WITH PLAYER
                                foreach ($get_summoner_match_data_obj as $gameData) {
                                    if ($get_summoner_match_data_obj['gameId'] == $summoner_matches_data['gameId']) {
                                        echo "dataobj-champ::" . $get_summoner_match_data_obj['participants'][9]['championId'];
                                        echo "<br>";
                                        
                                        echo "<br>";
                                        echo "matches-champ::" . $summoner_matches_data['champion'];
                                        echo "</div>
                                            <div class='col-md-2 mt-4 text-center match_history_col'>
                                                <div class='container'>
                                                <h5 class='p-0 m-0'>$champion[name]</h5>
                                                    <div class='row'>
                                                        <div class='col-6'>
                                                        </div>
                                                        <div class='col-6'>
                                                           SPELL_2.png
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-6'>
                                                            RUNE_1.png
                                                        </div>
                                                        <div class='col-6'>
                                                           RUNE_2.png
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class='col-md-3 p-0 m-0 text-center'>
                                            <div class='vl'></div>
                                                <div class='card-body text-left mt-2'>
                                                    ";

                                        if ($get_summoner_match_data_obj['teams']['1']['win'] == "Win") {
                                            $get_summoner_match_data_obj['teams']['1']['win'] = $match_win;
                                            $match_win = "Win <i class='far fa-smile fa-lg'></i>";
                                            echo "<p class='card-title p-0 m-0'>
                                                      <span class='badge badge_text alert-success'>";

                                            echo $match_win;
                                            echo "
                                                      </span>
                                                      </p>";
                                        } elseif ($get_summoner_match_data_obj['teams']['1']['win'] == "Fail") {
                                            $get_summoner_match_data_obj['teams']['1']['win'] = $match_lose;
                                            $match_lose = "Lose <i class='far fa-frown fa-lg'></i>";
                                            echo "<p class='card-title p-0 m-0'>
                                                      <span class='badge badge_text alert-danger'>";

                                            echo $match_lose;
                                            echo "
                                                      </span>
                                                      </p>";
                                        }

                                        echo "
                                                     
                                                    <p class='card-text p-0 m-0'><span class='badge badge_text alert-primary'>K/D/A</span></p>
                                                    <p class='card-text p-0 m-0'><span class='badge badge_text alert-warning'>CS_STATS</span></p>
                                                    <p class='card-text p-0 m-0'><span class='badge badge_text alert-danger'>KILL_PART</span></p>
                                                    <p class='card-title p-0 m-0'><span class='badge badge_text alert-info'>$summoner_matches_data[lane]</span></p>
                                                </div>
                                            </div>
                                            <div class='col-md-5 p-0 m-0 text-center'>
                                            <div class='vl'></div>
                                                <div class='card-body mt-4'>
                                                    <h5 class='card-title'>K/D/A</h5>
                                                    <h6 class='card-text'>BUILD.PNG</h6>
                                                </div>
                                            </div>
                                            
                                         </div>
                                        </div>
                                         <!-- FOREACH END -->
                                        ";
                                        break;
                                    }
                                }
                            }


                            ?>


                        </div>
                    </div>
                </div>
            </div>

</body>

</html>