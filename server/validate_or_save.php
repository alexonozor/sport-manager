<?php
session_start();

// Assuming form data is submitted via POST
require('validation_class.php');
require('connection.php');
$validator = new FormValidator();
$teamFormError = '';
$leagueFormError = '';


// Handle team form submission
if (isset($_POST['teamName'])) {
    $teamName = $_POST['teamName'];
    $isTeamFormValid = $validator->validateTeamForm($teamName);

    if ($isTeamFormValid) {
        // Perform database insertion
        $insertTeamQuery = "INSERT INTO teams (name) VALUES ('$teamName')";

        if (mysqli_query($connection, $insertTeamQuery)) {
            // Redirect to success page or display success message
            $_SESSION['teamFormSuccess'] = "Team inserted successfully.";

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            // Set error message
            $teamFormError = "Error: " . mysqli_error($connection);
        }
    } else {
        $teamFormErrors = $validator->getErrors();
        // Set error message
        $teamFormError = implode(', ', $teamFormErrors);
    }
}

// Handle league form submission
if (isset($_POST['leagueName'])) {
    $leagueName = $_POST['leagueName'];
    $isLeagueFormValid = $validator->validateLeagueForm($leagueName);

    if ($isLeagueFormValid) {
        // Perform database insertion
        $insertLeagueQuery = "INSERT INTO leagues (name) VALUES ('$leagueName')";

        if (mysqli_query($connection, $insertLeagueQuery)) {
            // Redirect to success page or display success message
            $_SESSION['leagueFormSuccess'] = "League inserted successfully.";

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            // Set error message
            $leagueFormError = "Error: " . mysqli_error($connection);
        }
    } else {
        $teamFormErrors = $validator->getErrors();
        // Set error message
       $teamFormError = implode(', ', $teamFormErrors);
    }
}

// Handle game form submission
if (isset($_POST['team1'], $_POST['team2'], $_POST['league'], $_POST['status'], $_POST['timestamp'])) {
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $league = $_POST['league'];
    $status = $_POST['status'];
    $timestamp = $_POST['timestamp'];

    $unixTimestamp = strtotime($timestamp);

    $isGameFormValid = $validator->validateGameForm($team1, $team2, $league, $status, $unixTimestamp);

    if ($isGameFormValid) {
        // Perform database insertion
        $insertGameQuery = "INSERT INTO games (team1_id, team2_id, league_id, status, unix_timestamp) 
                            VALUES ('$team1', '$team2', '$league', '$status', '$unixTimestamp')";

        if (mysqli_query($connection, $insertGameQuery)) {
            // Redirect to success page or display success message
            $_SESSION['gameFormSuccess'] = "Game inserted successfully.";

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            // Set error message
            $gameFormError = "Error: " . mysqli_error($connection);
        }
    } else {
        $gameFormErrors = $validator->getErrors();
        // Display error messages to the user interface
        // $gameFormErrora = implode(', ', $teamFormErrors);
        // foreach ($gameFormErrors as $error) {
        //     echo "<p class='error'>$error</p>";
        // }
    }
}


// Handle score form submission
if (isset($_POST['game'], $_POST['scope'], $_POST['team1Score'], $_POST['team2Score'])) {
    $game = $_POST['game'];
    $scope = $_POST['scope'];
    $team1Score = $_POST['team1Score'];
    $team2Score = $_POST['team2Score'];

    $isScoreFormValid = $validator->validateScoreForm($game, $scope, $team1Score, $team2Score);

    if ($isScoreFormValid) {
        // Perform database insertion
        $insertScoreQuery = "INSERT INTO scores (game_id, scope, team1_score, team2_score) 
                            VALUES ('$game', '$scope', '$team1Score', '$team2Score')";

        if (mysqli_query($connection, $insertScoreQuery)) {
            // Redirect to success page or display success message
            $_SESSION['scoreFormSuccess'] = "Score inserted successfully.";

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            // Set error message
            $scoreFormError = "Error: " . mysqli_error($connection);
        }
    } else {
        $scoreFormErrors = $validator->getErrors();
        // Display error messages to the user interface
        foreach ($scoreFormErrors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}


?>