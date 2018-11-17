<?php

include 'connection.php';

session_start();
$produs_cumparat=0;
if(isset($_SESSION['username'])){

}else{

  header("Location: login.php");
}


$cumpara = 0;
if (isset($_GET['cumpara'])) {

  $query = mysqli_query($db, "DELETE FROM cos_cumparaturi WHERE user_id = '" . $_SESSION['id'] . "'");
  if(mysqli_affected_rows($db)){
    $cumpara = 1;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Document</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>


<body>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script> 

  <div class="container">
    <div class="col-10 text-center">

      <?php if($cumpara == 1) {
        echo "<h1>Ai plasat comada cu succes</h1>";

      }
      ?>
      <table class="table">
          <thead>
            <th> Nume produse </th>
            <th> Pret </th>
            <th> Categorie </th>
          </thead>

          <tbody>
            <?php
  $sumaTotala = 0;
             $query= mysqli_query($db, "SELECT * FROM cos_cumparaturi WHERE user_id= '" .$_SESSION['id'] ."'");

              while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){

                $id_produs = $row['produs_id'];
                echo $id_produs . " ";
                $query2 = mysqli_query($db, "SELECT * FROM produse WHERE id= '" . $id_produs ."'");
                while( $row2 = mysqli_fetch_array($query2, MYSQLI_BOTH)) {
                  $nume_produs = $row2['nume'];
                  $pret_produs = $row2['pret'];
                  $categorie_produs = $row2['categorie'];

                  $sumaTotala = $sumaTotala + $pret_produs;
//ia informatiile din baza de date


             ?>
              <tr>
                <td> <?php echo $nume_produs; ?></td>
                <td> <?php echo $pret_produs; ?></td>
                <td> <?php echo $categorie_produs; ?></td>
                <!--afiseaza informatiile-->
              </tr>
             <?php




           }}
              ?>
            </tbody>
          </table>
          <h1>Suma toatala este: <?php echo $sumaTotala; ?></h1>
          <a href="cos_cumparaturi.php?cumpara=1" class="btn btn-danger">Plaseaza comanda</a>
</body>



</html>
