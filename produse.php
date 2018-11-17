<?php
include 'connection.php';

session_start();
$produs_cumparat = 0;

if (isset($_SESSION['username'])) {
} else {
    header("Location: login.php");

}
if(isset($_GET['id_produs'])) {
  $id_produs = $_GET['id_produs'];

  $query =  mysqli_query($db, "SELECT pret FROM produse WHERE id = '" . $id_produs . "'");
//METODA 1
$pret = "";

  while($row =  mysqli_fetch_array($query, MYSQLI_BOTH)) {
    $pret = $row['pret'];
  }

  //METODA 2
  //$query =  mysqli_query($db, "SELECT pret FROM produse WHERE id = '" . $id_produs . "'");
  //$pret =  mysqli_fetch_array($query, MYSQLI_BOTH); //$pret este vector
  //$pret = $pret[0]; //din vector il transformam in var normala



    $query = mysqli_query($db, "INSERT INTO cos_cumparaturi(`produs_id`, `user_id`, `pret`) VALUES('".$id_produs . "', '" . $_SESSION['id'] . "', '" . $pret ."' )");

  if(mysqli_insert_id($db)) {
    $produs_cumparat = 1;
  } else {
    echo mysqli_error($db);
  }


}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Produse</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <a href="logout.php" class="btn btn-secondary">Log out</a>
    <?php
    $numarProduse = 0;
    $query = mysqli_query($db, "SELECT COUNT(id) FROM cos_cumparaturi WHERE user_id ='" . $_SESSION['id'] . "'");
    $numarProduse = mysqli_fetch_array($query, MYSQLI_BOTH);
    $numarProduse = $numarProduse[0];

    //METODA 3
    $query = mysqli_query($db, "SELECT COUNT(id) FROM cos_cumparaturi WHERE user_id ='" . $_SESSION['id'] . "'");
    $numarProduse = mysqli_num_rows($query);


    ?>
    <a href="cos_cumparaturi.php" class="btn btn-warning">Cos cumparaturi(<?php echo $numarProduse; ?>)</a>

    <div class="container">
      <div class="col-10">
        <?php if ($produs_cumparat == 1){
          echo "<h1>Produsul a fost adaugat in cosul de cumparaturi</h1>";

        }
        ?>

          <table class="table">
            <thead>
              <th>Nume produs</th>
              <th>Pret</th>
              <th>Categorie</th>
              <th>Buy</th>
            </thead>
    <tbody>
    <?php
        $query = mysqli_query($db, "SELECT * FROM produse");

        while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
            $id_produs= $row['id'];
            $nume_produs = $row['nume'];
            $pret_produs = $row['pret'];
            $categorie_produs = $row['categorie'];
    ?>

            <tr>
              <td><?php echo $nume_produs; ?></td>
              <td><?php echo $pret_produs; ?></td>
              <td><?php echo $categorie_produs; ?></td>
              <td><a href="produse.php?id_produs=<?php echo $id_produs; ?>" class="btn btn-success">Cumpara</a></td>
            </tr>

    <?php
    }
       ?>
      </tbody>
    </table>
  </div>
</div>


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
