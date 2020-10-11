<?php
include_once 'database.php';

try 
{
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];

  $stm = $pdo->prepare("UPDATE task SET nombre=?,descripcion=? WHERE id=?");
  $stm->execute([
    $nombre,
    $descripcion,
    $id
  ]);
  echo "Se ha actualido una tarea";
}catch(PDOException $e)
{
  die("ERROR: {$e->getMessage()}");
}


?>




