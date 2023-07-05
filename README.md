Sure! Here's the documentation for the given tasks:

## Solution Documentation

### 1. Creating Database Tables

The MySQL queries to create the required tables can be found in the `backend/tables.php` file. These queries create the following tables:

1. `teams` table: This table stores information about the teams participating in the games.

   - Columns:
     - `id` (INT): The unique identifier for each team.
     - `name` (VARCHAR): The name of the team.

2. `leagues` table: This table stores information about the leagues in which the games are played.

   - Columns:
     - `id` (INT): The unique identifier for each league.
     - `name` (VARCHAR): The name of the league.

3. `games` table: This table stores information about the games.

   - Columns:
     - `id` (INT): The unique identifier for each game.
     - `team1_id` (INT): The ID of the first team participating in the game (foreign key to `teams` table).
     - `team2_id` (INT): The ID of the second team participating in the game (foreign key to `teams` table).
     - `league_id` (INT): The ID of the league in which the game is played (foreign key to `leagues` table).
     - `unix_time` (INT): The Unix timestamp representing the game's time.
     - `ht_score` (INT): The score of the game at halftime.
     - `ft_score` (INT): The score of the game at full time.

### 2. Creating HTML Forms

The HTML forms for inserting data into the tables can be found in the `backend/forms.php` file. These forms include front-end validations using HTML5 to ensure the required fields are filled before submitting the form.

The forms are using PHP validation as instructed.

### 3. Backend Data Validation

The PHP code for validating the form data is implemented using Object-Oriented Programming (OOP) principles and can be found in the `backend/validation_class.php` file. The `FormValidator` class is responsible for validating the form data based on specific rules and returning any validation errors.

### 4. Saving Form Data into Database

The MySQL queries to save the form data into the tables are implemented in the `backend/validate_and_save.php` file. This script retrieves the form data, validates it using the `FormValidator` class, and performs the necessary database insertions if the data is valid. If any errors occur during the database insertion process, appropriate error messages are returned.

### 5. Retrieving Games from Database

The PHP code to retrieve games from the database as an associative array is implemented in the `backend/games.php` file. This script queries the database using MySQL and fetches the required information about each game, including the team names, league name, unix_time, and scores for half time and full time. The retrieved data is stored in an associative array.

### 6. Outputting Games as JSON

The associative array containing the game data is then output as JSON using the `json_encode()` function in the `backend/games.php` file. This JSON data can be consumed by client-side applications to display the games in the desired format.

### Frontend (VueJS)

The frontend implementation is done using VueJS and can be found in the `frontend/sport-manager` directory. To start the Vue app, navigate to the `frontend` directory using the command line and run the following commands:

```shell
cd frontend/sport-manager
npm install       # Install project dependencies
npm run serve     # Start the

 development server
```

This will start the Vue app and provide a local development server where you can access the application in your web browser.

In the frontend, the VueJS framework is used to handle the form submission, perform client-side validations, and display error messages or success messages based on the response received from the backend.

The frontend design and layout can be customized as per the requirements of the application.