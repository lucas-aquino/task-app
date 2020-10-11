<?php 
  include_once 'database.php';

  $search = $_POST['busqueda'];

  if(!empty($search))
  {
    try
    {
      $stm = $pdo->prepare("SELECT * FROM task WHERE nombre LIKE '%$search%'");
      $stm->execute();
      $row = $stm->fetchAll(PDO::FETCH_ASSOC);
      $jsonStr = json_encode($row);
      echo $jsonStr;
    }catch(PDOException $e)
    {
      die("ERROR: {$e->getMessage()}");
    }


    
  }

?>