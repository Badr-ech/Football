<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Player Statistics</title>
  <base href="http://localhost:8000/footballia/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
<?php include '../inc/header.php';?>

<div class="content">
<h2>Player Statistics</h2>
<?php
include "../config/init.php";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

    // SQL query to fetch player statistics
    $qry = "SELECT ps.stat_id, p.name AS player_name, ps.goals, ps.assists, ps.yellow_cards, ps.red_cards, ps.appearances
            FROM PlayerStatistics ps
            JOIN Player p ON ps.player_id = p.player_id
            ORDER BY p.name;";

    $stmt = $conn->prepare($qry);
    $stmt->execute();

    // Display the player statistics in a table
    echo "<table>\n";
    echo "<caption>Player Statistics</caption>\n";
    echo "<tr><th>Stat ID</th><th>Player Name</th><th>Goals</th><th>Assists</th><th>Yellow Cards</th><th>Red Cards</th><th>Appearances</th></tr>\n";

    // Loop through each player's statistics and display them in rows
    while ($result = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $result['stat_id'] . "</td>";
        echo "<td>" . $result['player_name'] . "</td>";
        echo "<td>" . $result['goals'] . "</td>";
        echo "<td>" . $result['assists'] . "</td>";
        echo "<td>" . $result['yellow_cards'] . "</td>";
        echo "<td>" . $result['red_cards'] . "</td>";
        echo "<td>" . $result['appearances'] . "</td>";
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
