<?php

require("codebird\Codebird");

/**
 * Single server query
 */

$server = new statusbot\ServerQuery("Play.network.net", 19132, "mcpe");
$server->query();// updates the data from the servers

// Eampe of how to use the single server Query in a tweet
$serverTweet = "Your Server Status!\n\nPlayers: " . $server->getOnlinePlayers() . "/" . $server->getMaxPlayers() . "\n Server is " . ($server->isOnline() ? "online" : "offline");

/**
 * Gamemode query
 */

// You can add and remove servers to this array but make sure to keep the formatting.
$servers = [
    "example.network.net:19132/mcpe",
    "example2.network.net:19133/mcpe",
    "example3.network.net:19134/mcpe",
    "example4.network.net:19135/mcpe"
];

$gamemode = new statusbot\GamemodeQuery($servers);
$gamemode->query(); // updates the data from the servers

// Example of how to use the the gamemode Query in a tweet
$gamemodeTweet = "Your Gamemode Status!\n\nGamemode\nPlayers: " . $gamemode->getOnlinePlayers() . "/" . $gamemode->getMaxPlayers() . "\nServers: " . $gamemode->getOnlineServers() . "/" . $gamemode->getMaxServers();

/**
 * Network Query
 */

$gamemodes = [
    "example" => [
        "example1.network.net:19132/mcpe",
        "examlple2.network.net:19133/mcpe"
    ],
    "2example" => [
        "2example1.network.net:19132/mcpe",
        "2example2.network.net:19133/mcpe"
    ]
];

$network = new statusbot\NetworkQuery($gamemodes);
$network->query();

// Example of how to use the the network Query in a tweet
$networkTweet = "Network Status!\n Example:\n  Players: " . $network->getOnlinePlayers("example") . "/" . $network->getMaxPlayers("example") . "  Servers: " . $network->getOnlineServers("example") . "/" . $network->getMaxServers("example") . "Example2:" . "\n  Players: " . $network->getOnlinePlayers("2example") . "/" . $network->getMaxPlayers("2example") . "\n  Servers: " . $network->getOnlineServers("2example") . "/" . $network->getMaxServers("2example");


/**
 * Tweet!
 */

// Edit these to match your twitter accounts info (Must be a registered development account)
$consumerKey = "";
$consumerSecret= "";
$accessToken = "";
$accessTokenSecret = "";

\codebird\Codebird::setConsumerKey($consumerKey, $consumerSecret);
$codebird = \codebird\Codebird::getInstance();
$codebird->setToken($accessToken, $accessTokenSecret);

$tweets = [$serverTweet, $gamemodeTweet, $networkTweet];

foreach($tweets as $tweet) {
        $codebird->statuses_update(["status" => $tweet]);
}