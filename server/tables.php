<?php

require_once 'connection.php';


// Create the "teams" table
$createTeamsTableQuery = "CREATE TABLE teams (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
)";
mysqli_query($connection, $createTeamsTableQuery);

// Create the "leagues" table
$createLeaguesTableQuery = "CREATE TABLE leagues (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
)";
mysqli_query($connection, $createLeaguesTableQuery);

// Create the "games" table
$createGamesTableQuery = "CREATE TABLE games (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    team1_id INT(11),
    team2_id INT(11),
    league_id INT(11),
    status ENUM('notstarted', 'ft', 'ht'),
    unix_timestamp INT(11),
    FOREIGN KEY (team1_id) REFERENCES teams(id),
    FOREIGN KEY (team2_id) REFERENCES teams(id),
    FOREIGN KEY (league_id) REFERENCES leagues(id)
)";
mysqli_query($connection, $createGamesTableQuery);

// Create the "scores" table
$createScoresTableQuery = "CREATE TABLE scores (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    game_id INT(11),
    scope ENUM('ft', 'ht'),
    team1_score INT(2),
    team2_score INT(2),
    FOREIGN KEY (game_id) REFERENCES games(id)
)";
mysqli_query($connection, $createScoresTableQuery);

?>
