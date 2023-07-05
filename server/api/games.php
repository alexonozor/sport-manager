<?php

require_once('cors.php');
$data = json_decode(file_get_contents('php://input'), true);

// Assuming form data is submitted via POST
require('../validation_class.php');
require('../connection.php');
$validator = new FormValidator();
$teamFormError = '';
$leagueFormError = '';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Handle team form submission
if (isset($data['team1'], $data['team2'], $data['league'], $data['status'], $data['timestamp'])) {
    $team1 = $data['team1'];
    $team2 = $data['team2'];
    $league = $data['league'];
    $status = $data['status'];
    $timestamp = $data['timestamp'];

    $unixTimestamp = strtotime($timestamp);

    $isGameFormValid = $validator->validateGameForm($team1, $team2, $league, $status, $unixTimestamp);

    if ($isGameFormValid) {
        // Perform database insertion
        $insertGameQuery = "INSERT INTO games (team1_id, team2_id, league_id, status, unix_timestamp) 
                            VALUES ('$team1', '$team2', '$league', '$status', '$unixTimestamp')";

        if (mysqli_query($connection, $insertGameQuery)) {
            // Redirect to success page or display success message
            echo json_encode(['status' => 'success', 'message' => 'League inserted successfully. ']);
            exit();
        } else {
            // Set error message
            $teamFormError = "Error: " . mysqli_error($connection);
            echo json_encode(['status' => 'error', 'messages' => $teamFormError]);
        }
    } else {
        $teamFormErrors = $validator->getErrors();
        echo json_encode(['status' => 'error', 'messages' => $teamFormErrors]);
    }
    
   }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch all games from the database
    $selectgamesQuery = "SELECT * FROM games";
    $result = mysqli_query($connection, $selectgamesQuery);

    if ($result) {
        $games = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $games[] = $row;
        }
        echo json_encode(['status' => 'success', 'games' => $games]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to fetch games']);
    }
}
?>