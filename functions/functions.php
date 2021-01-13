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

//!------------
//*---get Current Game Data
$get_live_game_url = "https://tr1.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/$summoner_id?api_key=$api_key";
$get_live_game_json = file_get_contents("$get_live_game_url");
$get_live_game_obj = json_decode($get_live_game_json, true);
//*----END Current Game Data
//!------------
?>