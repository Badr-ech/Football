<?php 
  session_start(); 

  // Redirect if no match has been added or if user isn't logged in (if needed)
  if (!isset($_SESSION['match_added']) && !isset($_SESSION['name'])) {
        $_SESSION['msg'] = "You need to add a match first";
        header('location: add_match.php'); // Directing the user to the match addition page
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <base href="http://localhost:8000/saleco/">
  <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<body>
  <?php include '../inc/header.php';?>

  <div class="content">
    <h2>Home Page</h2>

    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- If the match has been added successfully -->
    <?php if (isset($_SESSION['match_added'])) : ?>
      <div class="success">
        <h3>Match has been added successfully!</h3>
        <?php 
          unset($_SESSION['match_added']);
        ?>
      </div>
    <?php endif ?>

    <!-- If the user has added a match -->
    <?php if (isset($_SESSION['name'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['name']; ?></strong></p>
    <?php endif ?>
  </div>

  <?php include '../inc/footer.php';?>
</body>
</html>
