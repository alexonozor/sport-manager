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
if (isset($data['leagueName'])) {
    $leagueName = $data['leagueName'];
    $isTeamFormValid = $validator->validateTeamForm($leagueName);

    if ($isTeamFormValid) {
        // Perform database insertion
        $insertTeamQuery = "INSERT INTO leagues (name) VALUES ('$leagueName')";

        if (mysqli_query($connection, $insertTeamQuery)) {
            // Redirect to success page or display success message
            echo json_encode(['status' => 'success', 'message' => 'League inserted successfully. ' . $data['leagueName']]);

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
    // Fetch all leagues from the database
    $selectleaguesQuery = "SELECT * FROM leagues";
    $result = mysqli_query($connection, $selectleaguesQuery);

    if ($result) {
        $leagues = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $leagues[] = $row;
        }
        echo json_encode(['status' => 'success', 'leagues' => $leagues]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to fetch leagues']);
    }
}
?>