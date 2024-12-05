<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teams</title>
  <base href="http://localhost:8000/footballia/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
<?php include '../inc/header.php';?>

<div class="content">
<h2>Teams</h2>
<?php
include "../config/init.php";
try {
    // Connect to the database
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

    // Query to fetch team details along with their league
    $qry = "SELECT t.team_id, t.name AS team_name, t.coach, t.total_matches_played, t.points, 
                   t.wins, t.losses, t.draws, t.goals_for, t.goals_against, t.goal_difference, t.ranking, l.league_name
            FROM Team t
            JOIN League l ON t.league_id = l.league_id
            ORDER BY t.ranking;";

    $stmt = $conn->prepare($qry);
    $stmt->execute();

    // Display the results in a table
    echo "<table>\n";
    echo "<caption>Teams</caption>\n";
    echo "<tr><th>Team ID</th><th>Team Name</th><th>Coach</th><th>Total Matches</th><th>Points</th><th>Wins</th><th>Losses</th><th>Draws</th><th>Goals For</th><th>Goals Against</th><th>Goal Difference</th><th>Ranking</th><th>League</th></tr>\n";

    // Loop through each team and display their details
    while ($result = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $result['team_id'] . "</td>";
        echo "<td>" . $result['team_name'] . "</td>";
        echo "<td>" . $result['coach'] . "</td>";
        echo "<td>" . $result['total_matches_played'] . "</td>";
        echo "<td>" . $result['points'] . "</td>";
        echo "<td>" . $result['wins'] . "</td>";
        echo "<td>" . $result['losses'] . "</td>";
        echo "<td>" . $result['draws'] . "</td>";
        echo "<td>" . $result['goals_for'] . "</td>";
        echo "<td>" . $result['goals_against'] . "</td>";
        echo "<td>" . $result['goal_difference'] . "</td>";
        echo "<td>" . $result['ranking'] . "</td>";
        echo "<td>" . $result['league_name'] . "</td>";
        echo "</tr>\n";
    }

    echo "</table>\n";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
</div>

<?php include '../inc/footer.php';?>
</body>
</html>
