<?php
session_start();

// initializing variables
$league_id = "";
$team1_id = "";
$team2_id = "";
$date = "";
$time = "";
$final_score = "";
$location = "";
$errors = array(); 

include "../config/init.php";

try {
  // Connect to the database
  $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

  // Add match
  if (isset($_POST['add_match'])) {
    // Receive all input values from the form
    $league_id = $_POST['league_id'];
    $team1_id = $_POST['team1_id'];
    $team2_id = $_POST['team2_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $final_score = $_POST['final_score'];
    $location = $_POST['location'];

    // Check that the mandatory form fields are filled
    if (empty($league_id)) {
      array_push($errors, "League is required");
    }
    if (empty($team1_id)) {
      array_push($errors, "Team 1 is required");
    }
    if (empty($team2_id)) {
      array_push($errors, "Team 2 is required");
    }
    if (empty($date)) {
      array_push($errors, "Date is required");
    }
    if (empty($time)) {
      array_push($errors, "Time is required");
    }
    if (empty($final_score)) {
      array_push($errors, "Final score is required");
    }
    if (empty($location)) {
      array_push($errors, "Location is required");
    }

    // Check if the match already exists
    $qry = "SELECT 1
            FROM `Match`
            WHERE league_id = :league_id AND
                  (team1_id = :team1_id AND team2_id = :team2_id OR team1_id = :team2_id AND team2_id = :team1_id)
            AND date = :date AND time = :time";
    
    $stmt = $conn->prepare($qry);
    $stmt->execute([
      ':league_id' => $league_id,
      ':team1_id' => $team1_id,
      ':team2_id' => $team2_id,
      ':date' => $date,
      ':time' => $time
    ]);
    
    if ($stmt->fetch()) { // If the match already exists
      array_push($errors, "This match already exists for the selected league and teams.");
    }

    // Add match if there are no errors
    if (count($errors) == 0) {
      // First, get the max match ID
      $qry = "SELECT MAX(match_id) AS maxid FROM `Match`;";
      $stmt = $conn->prepare($qry);
      $stmt->execute();
      $result = $stmt->fetch();
      $match_id = 1 + intval($result['maxid']);

      // Insert match data into the Match table
      $sql = "INSERT INTO `Match` (match_id, league_id, team1_id, team2_id, date, time, final_score, location)
              VALUES (:match_id, :league_id, :team1_id, :team2_id, :date, :time, :final_score, :location)";
      
      $stmt = $conn->prepare($sql);
      $stmt->execute([
        ':match_id' => $match_id,
        ':league_id' => $league_id,
        ':team1_id' => $team1_id,
        ':team2_id' => $team2_id,
        ':date' => $date,
        ':time' => $time,
        ':final_score' => $final_score,
        ':location' => $location
      ]);

      $_SESSION['success'] = "Match added successfully!";
      header('location: match_list.php'); // Redirect to the match listing page or a success page
    }
  }
} catch(PDOException $e) {
  echo "SQL Error: " . $e->getMessage();
} catch(Error $e) {
  echo "Error: " . $e->getMessage();
}
?>
