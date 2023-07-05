<?php

require_once('cors.php');   
$data = json_decode(file_get_contents('php://input'), true);

// Assuming form data is submitted via POST
require('../validation_class.php');
require('../connection.php');
$validator = new FormValidator();
$teamFormError = '';
$leagueFormError = '';


// Handle team form submission
if (isset($data['teamName'])) {
    $teamName = $data['teamName'];
    $isTeamFormValid = $validator->validateTeamForm($teamName);

    if ($isTeamFormValid) {
        // Perform database insertion
        $insertTeamQuery = "INSERT INTO teams (name) VALUES ('$teamName')";

        if (mysqli_query($connection, $insertTeamQuery)) {
            // Redirect to success page or display success message
            echo json_encode(['status' => 'success', 'message' => 'Team inserted successfully. ' . $data['teamName']]);

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
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch all teams from the database
    $selectTeamsQuery = "SELECT * FROM teams";
    $result = mysqli_query($connection, $selectTeamsQuery);

    if ($result) {
        $teams = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $teams[] = $row;
        }
        echo json_encode(['status' => 'success', 'teams' => $teams]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to fetch teams']);
    }
}
?>