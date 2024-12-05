<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Football Matches</title>
  <base href="http://localhost:8000/footballia/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
<?php include '../inc/header.php';?>

<div class="content">
<h2>Football Matches</h2>
<?php
include "../config/init.php";
try {
    // Connect to the database
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

    // Query to fetch match details along with league and team information
    $qry = "SELECT m.match_id, l.league_name, m.date, m.time, m.final_score, m.location,
                   t1.name AS team1_name, t2.name AS team2_name
            FROM `Match` m
            JOIN League l ON m.league_id = l.league_id
            JOIN Team t1 ON m.team1_id = t1.team_id
            JOIN Team t2 ON m.team2_id = t2.team_id
            ORDER BY m.date DESC, m.time DESC;";

    $stmt = $conn->prepare($qry);
    $stmt->execute();

    // Display the results in a table
    echo "<table>\n";
    echo "<caption>Football Matches</caption>\n";
    echo "<tr><th>Match ID</th><th>League</th><th>Team 1</th><th>Team 2</th><th>Date</th><th>Time</th><th>Final Score</th><th>Location</th></tr>\n";

    // Loop through each match and display details
    while ($result = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $result['match_id'] . "</td>";
        echo "<td>" . $result['league_name'] . "</td>";
        echo "<td>" . $result['team1_name'] . "</td>";
        echo "<td>" . $result['team2_name'] . "</td>";
        echo "<td>" . $result['date'] . "</td>";
        echo "<td>" . $result['time'] . "</td>";
        echo "<td>" . $result['final_score'] . "</td>";
        echo "<td>" . $result['location'] . "</td>";
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

