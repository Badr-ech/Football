<?php
include('../config/init.php');

if (isset($_POST['add_match'])) {
    // Get form data
    $league_id = $_POST['league_id'];
    $team1_id = $_POST['team1_id'];
    $team2_id = $_POST['team2_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $final_score = $_POST['final_score'];
    $location = $_POST['location'];

    // Prepare SQL query to insert match
    $query = "INSERT INTO `Match` (league_id, team1_id, team2_id, date, time, final_score, location) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("iiissss", $league_id, $team1_id, $team2_id, $date, $time, $final_score, $location);
        if ($stmt->execute()) {
            echo "Match added successfully!";
        } else {
            echo "Error: Could not execute query.";
        }
    } else {
        echo "Error: Could not prepare query.";
    }
}
?>
