<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Match</title>
  <base href="http://localhost:8000/saleco/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>
<body>
  <?php include '../inc/header.php';?>

  <div class="content">
    <h2>Add Match</h2>

    <form method="post" action="match/add_match.php">
      <?php include('errors.php'); ?>

      <!-- League Selection -->
      <div class="input-group">
        <label>League</label>
        <select name="league_id" required>
          <option value="">Select League</option>
          <?php
          // Fetch leagues from the database
          $query = "SELECT * FROM League";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['league_id'] . "'>" . $row['league_name'] . " (" . $row['season'] . ")</option>";
          }
          ?>
        </select>
      </div>

      <!-- Team 1 Selection -->
      <div class="input-group">
        <label>Team 1</label>
        <select name="team1_id" required>
          <option value="">Select Team 1</option>
          <?php
          // Fetch teams from the database
          $query = "SELECT * FROM Team";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['team_id'] . "'>" . $row['name'] . "</option>";
          }
          ?>
        </select>
      </div>

      <!-- Team 2 Selection -->
      <div class="input-group">
        <label>Team 2</label>
        <select name="team2_id" required>
          <option value="">Select Team 2</option>
          <?php
          // Fetch teams from the database
          $query = "SELECT * FROM Team";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['team_id'] . "'>" . $row['name'] . "</option>";
          }
          ?>
        </select>
      </div>

      <!-- Match Date -->
      <div class="input-group">
        <label>Date</label>
        <input type="date" name="date" required>
      </div>

      <!-- Match Time -->
      <div class="input-group">
        <label>Time</label>
        <input type="time" name="time" required>
      </div>

      <!-- Final Score -->
      <div class="input-group">
        <label>Final Score</label>
        <input type="text" name="final_score" placeholder="e.g., 2-1" required>
      </div>

      <!-- Location -->
      <div class="input-group">
        <label>Location</label>
        <input type="text" name="location" placeholder="Venue" required>
      </div>

      <!-- Submit Button -->
      <div class="input-group">
        <button type="submit" class="btn" name="add_match">Add Match</button>
      </div>
    </form>
  </div>

  <?php include '../inc/footer.php';?>
</body>
</html>
