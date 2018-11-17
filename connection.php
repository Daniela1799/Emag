<?php
$db = mysqli_connect('localhost', 'root', '', 'asd');

if($db) {
      //echo "Conexiune la baza de date";
  } else {
    echo mysqli_error($db);
  }
  ?>
