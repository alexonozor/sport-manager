<?php

class FormValidator {
    private $errors = [];

    public function validateTeamForm($teamName) {
        // Clear previous errors
        $this->errors = [];

        // Validate team name
        if (empty($teamName)) {
            $this->addError('teamName', 'Team name is required.');
        } elseif (strlen($teamName) > 255) {
            $this->addError('teamName', 'Team name must be less than 255 characters.');
        }

        // Return true if no errors
        return empty($this->errors);
    }

    public function validateLeagueForm($leagueName) {
        // Clear previous errors
        $this->errors = [];

        // Validate league name
        if (empty($leagueName)) {
            $this->addError('leagueName', 'League name is required.');
        } elseif (strlen($leagueName) > 255) {
            $this->addError('leagueName', 'League name must be less than 255 characters.');
        }

        // Return true if no errors
        return empty($this->errors);
    }

    public function validateGameForm($team1, $team2, $league, $status, $timestamp) {
        // Clear previous errors
        $this->errors = [];

        // Validate team IDs, league ID, status, and timestamp
        // You can add more specific validations as per your requirements

        if (empty($team1)) {
            $this->addError('team1', 'Team 1 is required.');
        }

        if (empty($team2)) {
            $this->addError('team2', 'Team 2 is required.');
        }

        if (empty($league)) {
            $this->addError('league', 'League is required.');
        }

        if (empty($status)) {
            $this->addError('status', 'Status is required.');
        }

        if (empty($timestamp)) {
            $this->addError('timestamp', 'Timestamp is required.');
        }

        // Return true if no errors
        return empty($this->errors);
    }

    public function validateScoreForm($game, $scope, $team1Score, $team2Score) {
        // Clear previous errors
        $this->errors = [];

        // Validate game ID, score scope, team scores, etc.
        // You can add more specific validations as per your requirements

        if (empty($game)) {
            $this->addError('game', 'Game is required.');
        }

        if (empty($scope)) {
            $this->addError('scope', 'Scope is required.');
        }

        if (empty($team1Score)) {
            $this->addError('team1Score', 'Team 1 score is required.');
        }

        if (empty($team2Score)) {
            $this->addError('team2Score', 'Team 2 score is required.');
        }

        // Return true if no errors
        return empty($this->errors);
    }

    private function addError($field, $message) {
        $this->errors[$field] = $message;
    }

    public function getErrors() {
        return $this->errors;
    }
}

// Example usage:

// Assuming form data is submitted via POST

$validator = new FormValidator();

// Validate team form
if (isset($_POST['teamName'])) {
    $teamName = $_POST['teamName'];
    $isTeamFormValid = $validator->validateTeamForm($teamName);

    if ($isTeamFormValid) {
        // Perform database insertion or further processing
        // Redirect to success page or display success message
    } else {
        $teamFormErrors = $validator->getErrors();
        // Display error messages to the user interface
    }
}

// Validate league form
if (isset($_POST['leagueName'])) {
    $leagueName = $_POST['leagueName'];
    $isLeagueFormValid = $validator->validateLeagueForm($leagueName);

    if ($isLeagueFormValid) {
        // Perform database insertion or further processing
        // Redirect to success page or display success message
    } else {
        $leagueFormErrors = $validator->getErrors();
        // Display error messages to the user interface
    }
}

// Validate game form
if (isset($_POST['team1'], $_POST['team2'], $_POST['league'], $_POST['status'], $_POST['timestamp'])) {
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $league = $_POST['league'];
    $status = $_POST['status'];
    $timestamp = $_POST['timestamp'];

    $isGameFormValid = $validator->validateGameForm($team1, $team2, $league, $status, $timestamp);

    if ($isGameFormValid) {
        // Perform database insertion or further processing
        // Redirect to success page or display success message
    } else {
        $gameFormErrors = $validator->getErrors();
        // Display error messages to the user interface
    }
}

// Validate score form
if (isset($_POST['game'], $_POST['scope'], $_POST['team1Score'], $_POST['team2Score'])) {
    $game = $_POST['game'];
    $scope = $_POST['scope'];
    $team1Score = $_POST['team1Score'];
    $team2Score = $_POST['team2Score'];

    $isScoreFormValid = $validator->validateScoreForm($game, $scope, $team1Score, $team2Score);

    if ($isScoreFormValid) {
        // Perform database insertion or further processing
        // Redirect to success page or display success message
    } else {
        $scoreFormErrors = $validator->getErrors();
        // Display error messages to the user interface
    }
}

?>
