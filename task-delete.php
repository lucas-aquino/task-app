<?php 
  require_once 'database.php';

  if(isset($_POST['id']))
  {
    $id = $_POST['id'];
    try
    {
      $stm = $pdo->prepare("DELETE FROM task WHERE id=?");
      $stm->execute([$id]);
      echo "Se ha eliminado una tarea";
    }catch(PDOException $e)
    {
      die("ERROR: {$e->getMessage()}");
    }
  }


?>