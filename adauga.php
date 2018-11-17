<?php
  include 'connection.php';
//salvam ce primim de la HTML in variabile
  $nume = $_POST['nume'];
  $pret = $_POST['pret'];
  $categorie = $_POST['categorie'];

$nume_safe = mysqli_escape_string($db, $nume);
$pret_safe = mysqli_escape_string($db, $pret);
$categorie_safe= mysqli_escape_string($db, $categorie);
/* sanitizez codul sa nu aiba caractere nepermise
Sia apoi introduc in baza de date */


//chestia verde sus
if(mysqli_insert_id($db)){
  echo "Am adaugat produsul cu numele: " . $nume. "<br/>";
  echo "Pretul produsului este: " . $pret . "<br/>";
  echo "Categoria produsului este: " . $categorie . "<br/>";

}else{
  echo mysqli_error($db);
}

$query = mysqli_query($db, "INSERT INTO produse(nume,pret,categorie) VALUES ('$nume_safe', '$pret_safe', '$categorie_safe')");

echo "Am adaugat produsul cu numele: " . $nume. "<br/>";
echo "Pretul produsului este: " . $pret . "<br/>";
echo "Categoria produsului este: " . $categorie . "<br/>";
 ?>
