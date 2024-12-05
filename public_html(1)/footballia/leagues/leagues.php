<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leagues</title>
  <base href="http://localhost:8000/footballia/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
<?php include '../inc/header.php';?>

<div class="content">
<h2>Leagues</h2>
<?php
include "../config/init.php";
try {
    // Connect to the database
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

    // Query to fetch league details
    $qry = "SELECT league_id, league_name, season, start_date, end_date
            FROM League
            ORDER BY start_date;";

    $stmt = $conn->prepare($qry);
    $stmt->execute();

    // Display the results in a table
    echo "<table>\n";
    echo "<caption>Leagues</caption>\n";
    echo "<tr><th>League ID</th><th>League Name</th><th>Season</th><th>Start Date</th><th>End Date</th></tr>\n";

    // Loop through each league and display its details
    while ($result = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $result['league_id'] . "</td>";
        echo "<td>" . $result['league_name'] . "</td>";
        echo "<td>" . $result['season'] . "</td>";
        echo "<td>" . $result['start_date'] . "</td>";
        echo "<td>" . $result['end_date'] . "</td>";
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
