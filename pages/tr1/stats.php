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
    //!------------
    //*---get SummonerSpells
    $get_SummonerSpells = "http://ddragon.leagueoflegends.com/cdn/11.1.1/data/en_US/summoner.json";
    $get_SummonerSpells_json = file_get_contents("$get_SummonerSpells");
    $get_SummonerSpells_obj = json_decode($get_SummonerSpells_json, true);
    //*----END SummonerSpells
    
    //*---get SummonerRunes
    $get_SummonerRunes = "http://ddragon.leagueoflegends.com/cdn/11.1.1/data/en_US/runesReforged.json";
    $get_SummonerRunes_json = file_get_contents("$get_SummonerRunes");
    $get_SummonerRunes_obj = json_decode($get_SummonerRunes_json, true);
    //*----END SummonerRunes
    //!------------
    //*---get summoner match history
    $account_id = $get_summoner_obj->accountId;
    $get_summoner_matches_url = "https://tr1.api.riotgames.com/lol/match/v4/matchlists/by-account/$get_summoner_obj->accountId?api_key=$api_key";
    $get_summoner_matches_json = file_get_contents("$get_summoner_matches_url");
    $get_summoner_matches_obj = json_decode($get_summoner_matches_json, true);
    //*----END GET SUMMONER MATCH HISTORY
    //!------------
    //!------------
    //*---get summoner Masteries
    $summoner_id = $get_summoner_obj->id;
    
    $get_summoner_masteries_url = "https://tr1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$summoner_id?api_key=$api_key";
    $get_summoner_masteries_json = file_get_contents("$get_summoner_masteries_url");
    $get_summoner_masteries_obj = json_decode($get_summoner_masteries_json, true);
    //*----END GET SUMMONER Masteries
    //!------------
    //?----get summoner League
    //NOTE:DONT FORGET TO ADD API KEY
    
    $get_summoner_league = "https://tr1.api.riotgames.com/lol/league/v4/entries/by-summoner/$summoner_id?api_key=$api_key";
    $get_summoner_league_json = file_get_contents("$get_summoner_league");
    $get_summoner_league_obj = json_decode($get_summoner_league_json, true);

    ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-2">
                
            <?php 
            switch ($get_summoner_league_obj[0]['tier']) {
                case "IRON":
                    $league_border = "iron";
                    break;
                case "BRONZE":
                    $league_border = "bronze";
                    break;
                case "SILVER":
                    $league_border = "silver";
                    break;
                case "GOLD":
                    $league_border = "gold";
                    break;
                case "PLATINUM":
                    $league_border = "platinum";
                    break;
                case "DIAMOND":
                    $league_border = "diamond";
                        break;
                case "MASTER":
                    $league_border = "master";
                        break;
                case "GRANDMASTER":
                    $league_border = "grandmaster";
                        break;
                case "CHALLENGER":
                    $league_border = "challenger";
                        break;
                }

            /*if($get_summoner_league_obj[0]['tier'] == "SILVER")
            {
                $league_border = "silver";
            }*/
            
            ?>

                <?php echo "<img style='border-image: url(https://opgg-static.akamaized.net/images/borders2/$league_border.png) 12 stretch;' class='summoner_icon' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/profileicon/$get_summoner_obj->profileIconId.png' class='img-fluid' alt='LeagueIcon'>"; ?>

                <div class="row">
                    <div class="col-sm">
                        <?php echo "<h4 class='text-left pt-2'><span class='badge badge_text alert-primary'>$get_summoner_obj->name - $get_summoner_obj->summonerLevel</span></h4>" ?>
                    </div>
                </div>
            </div>
            <div style="margin-left: 2vw !important;" class="col-9 p-0 m-0">
                <div class="card summoner_league_card p-0 m-0">
                    <div class="card-body pl-2 m-0">
                        <div class="container p-0 m-0">
                            <div class="row">
                                <?php
                                foreach ($get_champs_obj['data'] as $fav_champion) {
                                    if ($fav_champion['key'] == $get_summoner_masteries_obj[0]['championId']) {
                                        echo "<div class='fav_champ_banner text-white'><img class='fav_banner' loading='lazy'
                                                src='http://lolg-cdn.porofessor.gg/img/banners/champion-banners/$fav_champion[key].jpg' alt='$fav_champion[id]'>
                                                <div class='card-img-overlay text-left'>
                                                    <p class='card-text mt-3 mb-0 p-0'>$fav_champion[id]</p>
                                                    <p class='card-text p-0 m-0'>" . $get_summoner_masteries_obj[0]['championLevel'] . " Level</p>
                                                    <p class='card-text p-0 m-0'> " . $get_summoner_masteries_obj[0]['championPoints'] . " Points</p>
                                                </div>
                                                </div>";
                                        break;
                                    }
                                }
                                
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card summoner_league_card mt-3">
                    <div class="card-body">
                        <div class="container">
                            <div class="row text-center">
                                <!-- //TODO:Show Unranked icon if user has no league -->
                                <?php
                                echo"
                                <div class='col-sm'>
                                    <img src='/assets/images/tier_emblems/BRIO.png' class='img-fluid summoner_rank' alt='Responsive image'>
                                <p>rank</p>
                                </div>
                                <div class='col-sm '>
                                    <img src='/assets/images/tier_emblems/" . $get_summoner_league_obj[0]['tier']. ".png' class='img-fluid summoner_rank' alt='Responsive image'>
                                    ";
                                    if($get_summoner_league_obj[0]['queueType'] = "RANKED_SOLO_5x5")
                                    {
                                        $queueType = "Ranked Solo/Duo";
                                    }
                                    echo"
                                    <p class='p-0 m-0'>$queueType </p>
                                    <p class='p-0 m-0'>" . $get_summoner_league_obj[0]['tier']. " " . $get_summoner_league_obj[0]['rank']. " " . $get_summoner_league_obj[0]['leaguePoints']. " LP</p>
                                    </div>
                                <div class='col-sm'>
                                    <img src='/assets/images/tier_emblems/Emblem_Gold.png' class='img-fluid summoner_rank' alt='Responsive image'>
                                </div>
                                ";
                                ?>
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
                                        
                                        //! CODE DIFFERENT FOREACH FOR EVERY ARRAY
                                foreach ($get_summoner_match_data_obj['participants'] as $game_participants_data) {
                                    if ($game_participants_data['championId'] == $summoner_matches_data['champion']) {
                                        break;
                                    }
                                }
                                        echo "</div>
                                            <div class='col-md-2 mt-4 text-center match_history_col'>
                                                <div class='container'>
                                                <h5 class='p-0 m-0'>$champion[name]</h5>
                                                    ";
                                                    
                                                    foreach ($get_SummonerSpells_obj['data'] as $game_spell_data) {
                                                        if ($game_spell_data['key'] == $game_participants_data['spell1Id']) {
                                                            echo"
                                                            <div class='row'>
                                                            <div class='col-6 p-0 m-0'>
                                                            <img class='summoner_spell' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$game_spell_data[id].png'>
                                                            </div>
                                                            
                                                        
                                                        ";
                                                            break;
                                                        }
                                                    }
                                                    foreach ($get_SummonerSpells_obj['data'] as $game_spell_data) {
                                                        if ($game_spell_data['key'] == $game_participants_data['spell2Id']) {
                                                            echo"
                                                            <div class='col-6 p-0 m-0'>
                                                            <img class='summoner_spell' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$game_spell_data[id].png'>

                                                            </div>
                                                        </div>
                                                        ";
                                                            break;
                                                        }
                                                    }
                                                    foreach ($get_SummonerRunes_obj as $game_rune_data) {
                                                        
                                                       
                                                        if ($game_rune_data['id'] == $game_participants_data['stats']['perkPrimaryStyle']) {
                                                            
                                                            echo"
                                                            <div class='row'>
                                                        <div class='col-6 p-0 m-0'>
                                                        <img class='summoner_rune p-0 mt-1' src='http://ddragon.leagueoflegends.com/cdn/img/$game_rune_data[icon]'>
                                                        </div>
                                                            
                                                        ";
                                                            break;
                                                        }
                                                    }
                                                    foreach ($get_SummonerRunes_obj as $game_rune_data) {
                                                        
                                                       
                                                        if ($game_rune_data['id'] == $game_participants_data['stats']['perkSubStyle']) {
                                                            
                                                            echo"
                                                            <div class='col-6 p-0 m-0'>
                                                            <img class='summoner_rune p-0 mt-1' src='http://ddragon.leagueoflegends.com/cdn/img/$game_rune_data[icon]'>
                                                        </div>
                                                            
                                                            
                                                        ";
                                                            break;
                                                        }
                                                    }
                                                      //echo"as" . $get_SummonerRunes_obj;  
                                                   echo"
                                                    
                                                        
                                                        
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
                                                     
                                                    <p class='card-text p-0 m-0'><span class='badge badge_text alert-primary'>
                                                    " . $game_participants_data['stats']['kills'] . "
                                                    / " . $game_participants_data['stats']['deaths'] . "
                                                    / " . $game_participants_data['stats']['assists'] . "
                                                    </span>
                                                    </p>
                                                    ";
                                                        $minion_count = $game_participants_data['stats']['totalMinionsKilled'] + $game_participants_data['stats']['neutralMinionsKilled'];
                                                    echo"
                                                    <p class='card-text p-0 m-0'><span class='badge badge_text alert-warning'>$minion_count CS</span></p>
                                                    <p class='card-text p-0 m-0'><span class='badge badge_text alert-danger'>" . $game_participants_data['stats']['totalDamageDealtToChampions'] ." Damage To Champions</span></p>
                                                    <p class='card-title p-0 m-0'><span class='badge badge_text alert-info'>$summoner_matches_data[lane]</span></p>
                                                </div>
                                            </div>
                                            <div class='col-md-5 p-0 m-0 text-center'>
                                            <div class='vl'></div>
                                                <div class='card-body mt-4'>
                                                   
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