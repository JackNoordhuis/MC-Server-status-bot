<?php

require_once 'statusbot/GamemodeQuery.php';
require_once "codebird/Codebird.php";

$servers = [
    "duel1.crazedcraftmc.net:19132/mcpe",
    "duel2.crazedcraftmc.net:19132/mcpe"
];
$gamemode = new \statusbot\GamemodeQuery($servers);
$gamemode->query();
$tweet = "CrazedCraft Network - Duels Status\n\n🔪 Playing: " . $gamemode->getOnlinePlayers() . "/" . $gamemode->getMaxPlayers() . "\n\n✈️ Servers: " . $gamemode->getOnlineServers() . "/" . $gamemode->getMaxServers();

$consumerKey = "";
$consumerSecret= "";
$accessToken = "";
$accessTokenSecret = "";

\codebird\Codebird::setConsumerKey($consumerKey, $consumerSecret);
$codebird = \codebird\Codebird::getInstance();
$codebird->setToken($accessToken, $accessTokenSecret);
$codebird->statuses_update(["status" => $tweet]);