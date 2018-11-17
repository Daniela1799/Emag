<?php
include 'connection.php';

session_start();

if (isset($_SESSION['username'])) {
  HEADER("Location: produse.php");

}


$error = 1;
if (isset($_POST['submit'])){



    $username = $_POST['username'];
    $parola = $_POST['parola'];

    // echo "usename: $username, parola: $parola";

    $query = mysqli_query($db, "SELECT id FROM user WHERE username='$username' AND parola='$parola'");

    if(mysqli_num_rows($query)) {
      $error = 0;
      $_SESSION['username'] = $username;
      while ($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
        $_SESSION['id'] = $row['id'];
        
      }
      header("Location: produse.php");

    }
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
      <title> Login page </title>
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>
<body>

  <?php
      if (isset($_POST['submit']) && $error == 1){
        echo "<h1 class='badge badge-danger'>Username sau parola incorecte</h1>";
      }
   ?>


  <div class="container">
    <div class="col-6 offset-3 text-center">
      <form action="login.php" method="POST">
        Username: <input type="text" class="form-control" name="username">
        <br/>
        Password: <input type="password" class="form-control" name="parola">
        <br/>
        <input type="submit" class="btn btn-warning" value="Autentificare" name="submit">
        </form>
    </div>
  </div>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>



</body>
</html>
