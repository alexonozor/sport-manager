<?php

require_once 'connection.php';


// Assuming you have already established a MySQL database connection

class Game {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getGames() {
        $query = "SELECT g.id, t1.name AS team1_name, t2.name AS team2_name, l.name AS league_name, g.status, g.unix_timestamp
            FROM games g
            INNER JOIN teams t1 ON g.team1_id = t1.id
            INNER JOIN teams t2 ON g.team2_id = t2.id
            INNER JOIN leagues l ON g.league_id = l.id";

        $result = mysqli_query($this->connection, $query);
        $games = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $game = array(
                'team1' => $row['team1_name'],
                'team2' => $row['team2_name'],
                'status' => $row['status'],
                'league' => $row['league_name'],
                'unix_time' => $row['unix_timestamp'],
                'scores' => array()
            );

            $gameId = $row['id'];
            $scoresQuery = "SELECT scope, team1_score FROM scores WHERE game_id = $gameId";
            $scoresResult = mysqli_query($this->connection, $scoresQuery);

            while ($scoreRow = mysqli_fetch_assoc($scoresResult)) {
                $score = array(
                    'scope' => $scoreRow['scope'],
                    'score' => $scoreRow['team1_score']
                );

                $game['scores'][] = $score;
            }

            $games[] = $game;
        }

        return $games;
    }
}

$game = new Game($connection);
$games = $game->getGames();

// Output the array as JSON
header('Content-Type: application/json');
echo json_encode(array('games' => $games));

?>



