<?php
  require_once 'database.php';

  if(isset($_POST['nombre']))
  {
    $nombre = $_POST['nombre'];
    $desc   = $_POST['descripcion'];
    
    try
    {
      $stm = $pdo->prepare("INSERT INTO task (nombre, descripcion) VALUES (?,?)");
      $stm->execute([$nombre, $desc]);
      echo "Se inserto una nueva tarea";
    }catch(PDOException $e)
    {
      die("ERROR: {$e->getMessage()}");
    }
  }
?>