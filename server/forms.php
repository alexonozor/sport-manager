<?php

require_once('tables.php');
require_once('validate_or_save.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Insert Forms</title>
    <style>
        .form-container {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="submit"] {
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h3>Create Team</h3>
        <?php if ($teamFormError): ?>
            <div class="error">
                <?php echo $teamFormError; ?>
            </div>
        <?php endif; ?>
        <!-- Display success message if team created successfully -->
        <?php if (isset($_SESSION['teamFormSuccess'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['teamFormSuccess']; ?>
            </div>
            <?php unset($_SESSION['teamFormSuccess']); ?> <!-- Clear the success message after displaying -->
        <?php endif; ?>


        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="teamName">Team Name:</label>
            <input type="text" id="teamName" name="teamName">
            <input type="submit" value="Create Team">
        </form>
    </div>

    <div class="form-container">
        <h3>Create League</h3>
        <?php if ($leagueFormError): ?>
            <div class="error">
                <?php echo $leagueFormError; ?>
            </div>
        <?php endif; ?>
        <!-- Display success message if team created successfully -->
        <?php if (isset($_SESSION['leagueFormSuccess'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['leagueFormSuccess']; ?>
            </div>
            <?php unset($_SESSION['leagueFormSuccess']); ?> <!-- Clear the success message after displaying -->
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="leagueName">League Name:</label>
            <input type="text" id="leagueName" name="leagueName" required>
            <input type="submit" value="Create League">
        </form>
    </div>

    <div class="form-container">
        <h3>Create Game</h3>
        <?php if ($leagueFormError): ?>
            <div class="error">
                <?php echo $leagueFormError; ?>
            </div>
        <?php endif; ?>
        <!-- Display success message if team created successfully -->
        <?php if (isset($_SESSION['leagueFormSuccess'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['leagueFormSuccess']; ?>
            </div>
            <?php unset($_SESSION['leagueFormSuccess']); ?> <!-- Clear the success message after displaying -->
        <?php endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="team1">Team 1:</label>
            <select id="team1" name="team1" required>
                <option value="">Select Team 1</option>
                <?php
                $selectTeamsQuery = "SELECT id, name FROM teams";
                $teamsResult = mysqli_query($connection, $selectTeamsQuery);

                while ($team = mysqli_fetch_assoc($teamsResult)) {
                    echo "<option value='" . $team['id'] . "'>" . $team['name'] . "</option>";
                }
                ?>
            </select>
            <label for="team2">Team 2:</label>
            <select id="team2" name="team2" required>
                <option value="">Select Team 2</option>
                <?php
                $teamsResult = mysqli_query($connection, $selectTeamsQuery);

                while ($team = mysqli_fetch_assoc($teamsResult)) {
                    echo "<option value='" . $team['id'] . "'>" . $team['name'] . "</option>";
                }
                ?>
            </select>
            <label for="league">League:</label>
            <select id="league" name="league" required>
                <option value="">Select League</option>
                <?php
                $selectLeaguesQuery = "SELECT id, name FROM leagues";
                $leaguesResult = mysqli_query($connection, $selectLeaguesQuery);

                while ($league = mysqli_fetch_assoc($leaguesResult)) {
                    echo "<option value='" . $league['id'] . "'>" . $league['name'] . "</option>";
                }
                ?>
            </select>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="notstarted">Not Started</option>
                <option value="ft">FT</option>
                <option value="ht">HT</option>
            </select>
            <label for="timestamp">Unix Timestamp:</label>
            <input id="timestamp" type="datetime-local" name="timestamp" required>
            <input type="submit" value="Create Game">
        </form>
    </div>


    <div class="form-container">
    <h3>Add Score</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="game">Game:</label>
        <select id="game" name="game" required>
            <option value="">Select Game</option>
            <?php
            // Fetch games from the database
            $fetchGamesQuery = "SELECT id FROM games";
            $result = mysqli_query($connection, $fetchGamesQuery);
            while ($row = mysqli_fetch_assoc($result)) {
                $gameId = $row['id'];
                echo "<option value='$gameId'>$gameId</option>";
            }
            ?>
        </select>
        <label for="scope">Scope:</label>
        <select id="scope" name="scope" required>
            <option value="">Select Scope</option>
            <option value="ft">FT</option>
            <option value="ht">HT</option>
        </select>
        <label for="team1Score">Team 1 Score:</label>
        <input type="number" id="team1Score" name="team1Score" required>
        <label for="team2Score">Team 2 Score:</label>
        <input type="number" id="team2Score" name="team2Score" required>
        <input type="submit" value="Add Score">
    </form>
</div>

</body>

</html>