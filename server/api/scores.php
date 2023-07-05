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
if (isset($data['game'], $data['scope'], $data['team1Score'], $data['team2Score'])) {
    $game = $data['game'];
    $scope = $data['scope'];
    $team1Score = $data['team1Score'];
    $team2Score = $data['team2Score'];

    $isScoreFormValid = $validator->validateScoreForm($game, $scope, $team1Score, $team2Score);

    if ($isScoreFormValid) {
        // Perform database insertion
        $insertScoreQuery = "INSERT INTO scores (game_id, scope, team1_score, team2_score) 
                            VALUES ('$game', '$scope', '$team1Score', '$team2Score')";

        if (mysqli_query($connection, $insertScoreQuery)) {
            echo json_encode(['status' => 'success', 'message' => 'Score inserted successfully. ']);

            exit();
        } else {
            // Set error message
            $scoreFormError = "Error: " . mysqli_error($connection);
            echo json_encode(['status' => 'error', 'messages' => $scoreFormError]);
        }
    } else {
        $scoreFormErrors = $validator->getErrors();
        // Display error messages to the user interface
        foreach ($scoreFormErrors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch all stores from the database
    $selectstoresQuery = "SELECT * FROM stores";
    $result = mysqli_query($connection, $selectstoresQuery);

    if ($result) {
        $stores = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $stores[] = $row;
        }
        echo json_encode(['status' => 'success', 'stores' => $stores]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to fetch stores']);
    }
}
?>