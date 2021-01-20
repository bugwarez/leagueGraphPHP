<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Summoner Stats</title>

</head>

<body>

    <?php include "../../config/config.php" ?>
    <?php include "../../components/navbar.php" ?>
    <?php
    require "../../functions/functions.php" ?>
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

                ?>

                <?php echo "<img style='border-image: url(https://opgg-static.akamaized.net/images/borders2/$league_border.png) 12 stretch;' class='summoner_icon' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/profileicon/$get_summoner_obj->profileIconId.png' class='img-fluid' alt='LeagueIcon'>"; ?>

                <div class="row">
                    <div class="col-sm">
                        <?php echo "<h4 class='text-left pt-2'><span class='badge badge_text alert-primary'>$get_summoner_obj->name - $get_summoner_obj->summonerLevel</span></h4>" ?>
                    </div>
                </div>
            </div>
            <div style="margin-left: 4vw !important;" class="col-9 p-0 m-0">
                <div class="card summoner_fav_card p-0 m-0">
                    <div class="card-body pl-3 m-0">
                        <div class="container p-0 m-0">
                            <div class="row ml-3">
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
    </div>
    <div class="container mt-3">
        <ul class="nav nav-pills nav-fill text-light" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active text-sm-center" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Match History</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-sm-center" id="league-tab" data-bs-toggle="tab" href="#league" role="tab" aria-controls="league" aria-selected="false">Leagues</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-sm-center" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Live Game</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-sm-center" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Champions</a>
            </li>


        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- //TODO!Match History Tab -->
                <div class="row mt-2">
                    <div class="col-sm mt-0">
                        <div class="card mt-0">
                            <div class="card-body mt-0">

                                <h5 class="text-center">Recent Matches</h5>

                                <!-- //TODO:DONT FORGET TO PUSH UPDATED CODE TO GITHUB -->

                                <?php
                                foreach (array_slice($get_summoner_matches_obj["matches"], 0, 5) as $summoner_matches_data) {
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





                                    foreach ($get_summoner_match_data_obj as $gameData) {
                                        if ($get_summoner_match_data_obj['gameId'] == $summoner_matches_data['gameId']) {


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
                                                    echo "
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
                                                    echo "
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

                                                    echo "
                                                            <div class='row'>
                                                        <div class='col-6 p-0 m-0'>
                                                        <img class='summoner_perk0_rune p-0 mt-1' src='/assets/images/perk0/" . $game_participants_data['stats']['perk0'] . ".png'>
                                                        </div>
                                                            
                                                        ";
                                                    break;
                                                }
                                            }
                                            foreach ($get_SummonerRunes_obj as $game_rune_data) {


                                                if ($game_rune_data['id'] == $game_participants_data['stats']['perkSubStyle']) {

                                                    echo "
                                                            <div class='col-6 p-0 m-0'>
                                                            <img class='summoner_rune p-0 mt-1' src='http://ddragon.leagueoflegends.com/cdn/img/$game_rune_data[icon]'>
                                                        </div>
                                                            
                                                            
                                                        ";
                                                    break;
                                                }
                                            }
                                            echo "<p class='mt-2'>
                                            <img class='summoner_position' src='../../assets/images/positions/$summoner_matches_data[lane]$summoner_matches_data[role].png'>
                                            </p>";

                                            echo "
                                                    
                                                        
                                                        
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
                                            //TODO! KEY RUNE ICONS INSTEAD OF TYPE ICON
                                            //TODO! Game History card background depends on match end 
                                            echo "
                                                    <p class='card-text p-0 m-0'><span class='badge badge_text alert-warning'>$minion_count CS</span></p>
                                                    <p class='card-text p-0 m-0'><span class='badge badge_text alert-danger'>" . $game_participants_data['stats']['totalDamageDealtToChampions'] . " Damage</span></p>
                                                    <p class='card-title p-0 m-0'><span class='badge badge_text alert-info'>" . date('i', $get_summoner_match_data_obj['gameDuration']) . "m " . date('s', $get_summoner_match_data_obj['gameDuration']) . "s</span></p>
                                                    

                                                    </div>
                                            </div>
                                            <div class='col-md-5 p-0 m-0 text-center'>
                                            <div class='vl'></div>
                                                <div class='card-body mt-4'>
                                                ";
                                            //TODO! VISION SCORE
                                            //TODO! Item Data on hover 
                                            //TODO! INGAME DATA IN DROPDOWN MENU FOR RECENT MATCHES
                                            #region //!Item Slots
                                            //!Item Slots
                                            $item0 = $game_participants_data['stats']['item0'];
                                            $item1 = $game_participants_data['stats']['item1'];
                                            $item2 = $game_participants_data['stats']['item2'];
                                            $item3 = $game_participants_data['stats']['item3'];
                                            $item4 = $game_participants_data['stats']['item4'];
                                            $item5 = $game_participants_data['stats']['item5'];
                                            $item6 = $game_participants_data['stats']['item6'];

                                            if ($item0 != "0") {
                                                echo "<img class='item_image' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/item/$item0.png'>";
                                            } else {
                                                echo "<img class='none_item_image' src='https://opgg-static.akamaized.net/images/pattern/opacity.1.png'>";
                                            }
                                            if ($item1 != "0") {
                                                echo "<img class='item_image' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/item/$item1.png'>";
                                            } else {
                                                echo "<img class='none_item_image' src='https://opgg-static.akamaized.net/images/pattern/opacity.1.png'>";
                                            }
                                            if ($item2 != "0") {
                                                echo "<img class='item_image' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/item/$item2.png'>";
                                            } else {
                                                echo "<img class='none_item_image' src='https://opgg-static.akamaized.net/images/pattern/opacity.1.png'>";
                                            }
                                            if ($item3 != "0") {
                                                echo "<img class='item_image' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/item/$item3.png'>";
                                            } else {
                                                echo "<img class='none_item_image' src='https://opgg-static.akamaized.net/images/pattern/opacity.1.png'>";
                                            }
                                            if ($item4 != "0") {
                                                echo "<img class='item_image' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/item/$item4.png'>";
                                            } else {
                                                echo "<img class='none_item_image' src='https://opgg-static.akamaized.net/images/pattern/opacity.1.png'>";
                                            }
                                            if ($item5 != "0") {
                                                echo "<img class='item_image' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/item/$item5.png'>";
                                            } else {
                                                echo "<img class='none_item_image' src='https://opgg-static.akamaized.net/images/pattern/opacity.1.png'>";
                                            }
                                            if ($item6 != "0") {
                                                echo "<img class='item_image' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/item/$item6.png'>";
                                            } else {
                                                echo "<img class='none_item_image' src='https://opgg-static.akamaized.net/images/pattern/opacity.1.png'>";
                                            }
                                            #endregion

                                            echo "
                                            
                                                </div>
                                                
                                                
                                                
                                            </div>
                                           
                                         </div>
                                         <button class='accordion'>Match Details</button>
                                                    <div class='panel'>
                                                        <div class='row my-4'>
                                                            <div class='col-sm'>
                                                            ";
                                                            foreach ($get_summoner_match_data_obj['participants'] as $recent_blue_team) {
                                                                if ($recent_blue_team['teamId'] == 100) {
                                                                    foreach ($get_champs_obj['data'] as $champion) {
                                                                        if ($champion['key'] == $recent_blue_team['championId']) {
                                                                            echo "
                                                                                            <p>
                                                                            <div class='card'>
                                                                            <div class='row'>
                                                                                <div class='card-body'>
                                                                                <div class='row'>
                                                                                    <div class='col-1'>
                                                                                    <h6 class='text-left pt-2'><span class='badge badge_text alert-danger recent_champ_level rounded-circle'>" . $recent_blue_team['stats']['champLevel'] . "</span></h6>
                                                                                <img loading='lazy'
                                                                                src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/champion/$champion[id].png' class='recent-match-champ' alt='...'>
                                                                                    </div>
                                                                                    ";


                                                            echo "
                                                                               
                                                                               
                                                                                    
                                                                                    <div class='col-1 mt-2 ml-0 p-0 align-middle bg-info'>
                                                                                    ";
                                                            foreach ($get_SummonerSpells_obj['data'] as $recent_game_spell_data) {
                                                                if ($recent_game_spell_data['key'] == $recent_blue_team['spell1Id']) {
                                                                    echo "
                                                                                                   
                                                                                            <img loading='lazy'
                                                                                            src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$recent_game_spell_data[id].png' class='recent-match-rune' alt='...'>
                                                                                                    
                                                                                                        ";
                                                                }
                                                            }
                                                            echo "
                                                                                    
                                                                               
                                                                               ";
                                                            foreach ($get_SummonerSpells_obj['data'] as $recent_game_spell_data) {
                                                                if ($recent_game_spell_data['key'] == $recent_blue_team['spell2Id']) {
                                                                    echo "
                                                                                           
                                                                                    <p>
                                                                               <img loading='lazy'
                                                                                    src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$recent_game_spell_data[id].png' class='recent-match-rune' alt='...'>
                                                                               </p>
                                                                               </div> ";
                                                                }
                                                            }
                                                            echo "
                                                                                    <div class='col-1 mt-2 ml-0 p-0 align-middle bg-warning'>
                                                                                    <img loading='lazy'
                                                                               src='/assets/images/perk0/" . $recent_blue_team['stats']['perk0'] . ".png' class='recent-match-rune' alt='...'>
                                                                               <hr style='padding:.1px; margin:0; height:.25vh;'>
                                                                               <p>
                                                                               ";

                                                            foreach ($get_SummonerRunes_obj as $game_rune_data) {


                                                                if ($game_rune_data['id'] == $recent_blue_team['stats']['perkSubStyle']) {

                                                                    echo "
                                                                                    <img loading='lazy'
                                                                                    src='http://ddragon.leagueoflegends.com/cdn/img/$game_rune_data[icon]' class='recent-match-sub-rune' alt='...'>
                                                                               </p>
                                                                                            
                                                                                            
                                                                               </div>";
                                                                    break;
                                                                }
                                                            }
                                                            echo "
                                                                               
                                                                               
                                                                                    
                                                                                    <div class='col-6 bg-success text-left p-0'>
                                                                                    ";
                                                            foreach ($get_summoner_match_data_obj['participantIdentities'] as $recent_blue_team_identities) {
                                                                if ($recent_blue_team['participantId'] == $recent_blue_team_identities['participantId']) {

                                                                    echo "<p style='margin-top:2vh !important;margin-left:1vw !important;padding:0 !important;'>" . $recent_blue_team_identities['player']['summonerName'] . "</p>";
                                                                    $recent_summoner_id = $recent_blue_team_identities['player']['summonerId'];

                                                                    $get_recent_summoner_league = "https://tr1.api.riotgames.com/lol/league/v4/entries/by-summoner/$recent_summoner_id?api_key=$api_key";
                                                                    $get_recent_summoner_league_json = file_get_contents("$get_recent_summoner_league");
                                                                    $get_recent_summoner_league_obj = json_decode($get_recent_summoner_league_json, true);

                                                                    //!------------
                                                                    if (isset($get_recent_summoner_league_obj[0]['tier'])) {
                                                                        echo "<p style='margin-top:2vh !important;margin-left:1vw !important;padding:0 !important;'>
                                                                        " . $get_recent_summoner_league_obj[0]['tier'] . " " . $get_recent_summoner_league_obj[0]['rank'] . "</p>";
                                                                    } else {
                                                                        echo "<p style='margin-top:2vh !important;margin-left:1vw !important;padding:0 !important;'>
                                                                        " . $get_summoner_obj->summonerLevel . " Level</p>";
                                                                    }
                                                                }
                                                            }



                                                            echo "
                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                                
                                                                                ";

                                                            echo "
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                                            </p>";
                                                                    }
                                                                }
                                                            }
                                                        }


                                            echo "

                                                            </div>
                                                            </div>
                                                            <div class='row'>
                                                            
                                                            </div>
                                                            <div class='col-1 text-center my-auto'>
                                                            <p class='text-center p-0 m-0'>
                                                            <img style='width: 4vw;' src='../../assets/images/versus.png'>
                                                        </p>
                                                            </div>
                                                            
                                                            <div class='col-sm'>
                                                            <p>
                                                            ";
                                            foreach ($get_summoner_match_data_obj['participants'] as $recent_red_team) {
                                                if ($recent_red_team['teamId'] == 200) {
                                                    foreach ($get_champs_obj['data'] as $champion) {
                                                        if ($champion['key'] == $recent_red_team['championId']) {
                                                            echo "
                                                                            <p>
                                                                            <div class='card'>
                                                                            <div class='row'>
                                                                                <div class='card-body'>
                                                                                <div class='row'>
                                                                                    <div class='col-2'>
                                                                                    <h6 class='text-left pt-2'><span class='badge badge_text alert-primary recent_champ_level rounded-circle'>" . $recent_red_team['stats']['champLevel'] . "</span></h6>
                                                                                <img loading='lazy'
                                                                                src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/champion/$champion[id].png' class='recent-match-champ' alt='...'>
                                                                                    </div>
                                                                                    ";


                                                            echo "
                                                                               
                                                                               
                                                                                    
                                                                                    <div class='col-1 mt-2 ml-0 p-0 align-middle'>
                                                                                    ";
                                                            foreach ($get_SummonerSpells_obj['data'] as $recent_game_spell_data) {
                                                                if ($recent_game_spell_data['key'] == $recent_red_team['spell1Id']) {
                                                                    echo "
                                                                                                   
                                                                                            <img loading='lazy'
                                                                                            src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$recent_game_spell_data[id].png' class='recent-match-rune' alt='...'>
                                                                                                    
                                                                                                        ";
                                                                }
                                                            }
                                                            echo "
                                                                                    
                                                                               <hr style='padding:.1px; margin:0; height:.25vh;'>
                                                                               ";
                                                            foreach ($get_SummonerSpells_obj['data'] as $recent_game_spell_data) {
                                                                if ($recent_game_spell_data['key'] == $recent_red_team['spell2Id']) {
                                                                    echo "
                                                                                           
                                                                                    <p>
                                                                               <img loading='lazy'
                                                                                    src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$recent_game_spell_data[id].png' class='recent-match-rune' alt='...'>
                                                                               </p>
                                                                               </div> ";
                                                                }
                                                            }
                                                            echo "
                                                                                    <div class='col-1 mt-2 ml-0 p-0 align-middle'>
                                                                                    <img loading='lazy'
                                                                               src='/assets/images/perk0/" . $recent_red_team['stats']['perk0'] . ".png' class='recent-match-rune' alt='...'>
                                                                               <hr style='padding:.1px; margin:0; height:.25vh;'>
                                                                               <p>
                                                                               ";

                                                            foreach ($get_SummonerRunes_obj as $game_rune_data) {


                                                                if ($game_rune_data['id'] == $recent_red_team['stats']['perkSubStyle']) {

                                                                    echo "
                                                                                    <img loading='lazy'
                                                                                    src='http://ddragon.leagueoflegends.com/cdn/img/$game_rune_data[icon]' class='recent-match-sub-rune' alt='...'>
                                                                               </p>
                                                                                            
                                                                                            
                                                                               </div>";
                                                                    break;
                                                                }
                                                            }
                                                            echo "
                                                                               
                                                                               
                                                                                    
                                                                                    <div class='col-4 text-left p-0'>
                                                                                    ";
                                                            foreach ($get_summoner_match_data_obj['participantIdentities'] as $recent_red_team_identities) {
                                                                if ($recent_red_team['participantId'] == $recent_red_team_identities['participantId']) {

                                                                    echo "<p style='margin-top:2vh !important;margin-left:1vw !important;padding:0 !important;'>" . $recent_red_team_identities['player']['summonerName'] . "</p>";
                                                                    echo "<p style='margin-top:0vh !important;margin-left:1vw !important;padding:0 !important;'>" . $recent_red_team_identities['player']['summonerName'] . "</p>";
                                                                }
                                                            }
                                                            echo "
                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                                
                                                                                ";

                                                            echo "
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                                            </p>";
                                                        }
                                                    }
                                                }
                                            }
                                            echo "
                                                            
                                                            
                                                            
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
            </div><!-- //!Match History Tab END -->

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-group">
                                    <?php
                                    //?Blue Team
                                    foreach ($get_live_game_obj['participants'] as $blueTeam) {
                                        if ($blueTeam['teamId'] == 100) {
                                            echo "
                                            <div class='card text-black mb-3' style='max-width: 14rem;'>
                                            <div class='card-header bg-primary text-white'>
                                            <img class='live_summoner_icon mr-0' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/profileicon/$blueTeam[profileIconId].png'>" . $blueTeam['summonerName'] . "</div>
                                            <div class='card-body'>
                                            ";
                                            foreach ($get_champs_obj['data'] as $champion) {
                                                if ($champion['key'] == $blueTeam['championId']) {
                                                    echo "<img loading='lazy'
                                                        src='http://ddragon.leagueoflegends.com/cdn/img/champion/loading/$champion[id]_0.jpg' class='card-img' alt='...'>";
                                                }
                                            }

                                            echo "
                                              <p class='card-text'>
                                              <div class='row'>
                                                    <div class='col-sm p-0 m-0'>
                                                    ";
                                            foreach ($get_SummonerSpells_obj['data'] as $live_game_spell_data) {
                                                if ($live_game_spell_data['key'] == $blueTeam['spell1Id']) {
                                                    echo "
                                                           
                                                            <img class='live_summoner_icon' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$live_game_spell_data[id].png'>
                                                            
                                                                ";
                                                }
                                            }
                                            foreach ($get_SummonerSpells_obj['data'] as $live_game_spell_data) {
                                                if ($live_game_spell_data['key'] == $blueTeam['spell2Id']) {
                                                    echo "
                                                           
                                                            <img class='live_summoner_icon' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$live_game_spell_data[id].png'>
                                                            
                                                                ";
                                                }
                                            }

                                            echo "
                                                    </div>
                                                    
                                                </div>
                                              </p>
                                            </div>
                                          </div>
                                                ";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-center p-0 m-0">
                    <img style="width: 7vw; padding: 2.2vh!important;" src="../../assets/images/versus.png">
                </p>

                <!-- //!Red Team -->
                <div style="margin: 0 !important; padding: 0 !important;" class="row">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-group">
                                    <?php
                                    //TODO!lIVE SUMMONER RUNES
                                    //TODO!SUMMONERS LEAGUES
                                    //TODO!GAME TIME
                                    foreach ($get_live_game_obj['participants'] as $redTeam) {
                                        if ($redTeam['teamId'] == 200) {
                                            echo "
                                            <div class='card text-black mb-3' style='max-width: 16rem;'>
                                            <div class='card-header bg-danger text-white'>
                                            <img class='live_summoner_icon mr-0' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/profileicon/$redTeam[profileIconId].png'>" . $redTeam['summonerName'] . "</div>
                                            <div class='card-body'>
                                            ";
                                            foreach ($get_champs_obj['data'] as $champion) {
                                                if ($champion['key'] == $redTeam['championId']) {
                                                    echo "<img loading='lazy'
                                                        src='http://ddragon.leagueoflegends.com/cdn/img/champion/loading/$champion[id]_0.jpg' class='card-img' alt='...'>";
                                                }
                                            }

                                            echo "
                                              <p class='card-text'>
                                              <div class='row'>
                                                    <div class='col-sm p-0 m-0'>
                                                    ";
                                            foreach ($get_SummonerSpells_obj['data'] as $live_game_spell_data) {
                                                if ($live_game_spell_data['key'] == $redTeam['spell1Id']) {
                                                    echo "
                                                           
                                                            <img class='live_summoner_icon' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$live_game_spell_data[id].png'>
                                                            
                                                                ";
                                                }
                                            }
                                            foreach ($get_SummonerSpells_obj['data'] as $live_game_spell_data) {
                                                if ($live_game_spell_data['key'] == $redTeam['spell2Id']) {
                                                    echo "
                                                           
                                                            <img class='live_summoner_icon' src='http://ddragon.leagueoflegends.com/cdn/11.1.1/img/spell/$live_game_spell_data[id].png'>
                                                            
                                                                ";
                                                }
                                            }

                                            echo "
                                                    </div>
                                                    
                                                </div>
                                              </p>
                                            </div>
                                          </div>
                                                ";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <!-- //TODO! CHMAPION MASTERIES -->
                dasdas
            </div>
            <div class="tab-pane fade" id="league" role="tabpanel" aria-labelledby="league-tab">
                <div class='card summoner_league_card mt-3'>
                    <div class="card-body">
                        <div class="container">
                            <div class="row text-center">
                                <!-- //TODO!Show Unranked icon if user has no league -->
                                <!-- //TODO! ALL LEAGUE DATA -->
                                <?php
                                echo "
                                <div class='col-sm'>
                                    <img src='/assets/images/tier_emblems/BRIO.png' class='img-fluid summoner_rank' alt='Responsive image'>
                                <p>rank</p>
                                </div>
                                <div class='col-sm '>
                                    <img src='/assets/images/tier_emblems/" . $get_summoner_league_obj[0]['tier'] . ".png' class='img-fluid summoner_rank' alt='Responsive image'>
                                    ";
                                if ($get_summoner_league_obj[0]['queueType'] = "RANKED_SOLO_5x5") {
                                    $queueType = "Ranked Solo/Duo";
                                }
                                echo "
                                    <p class='p-0 m-0'>$queueType </p>
                                    <p class='p-0 m-0'>" . $get_summoner_league_obj[0]['tier'] . " " . $get_summoner_league_obj[0]['rank'] . " " . $get_summoner_league_obj[0]['leaguePoints'] . " LP</p>
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
        <!-- //!Scripts -->
        <script src="../../assets/js/accordion.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="../../assets/js/win_lose_data.js"></script>
</body>

</html>