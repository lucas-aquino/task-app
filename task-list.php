<?php 
require_once 'database.php';

try
{
  $stm = $pdo->prepare("SELECT * FROM task");
  $stm->execute();
  $json = $stm->fetchAll(PDO::FETCH_ASSOC);
  $jsonStr = json_encode($json);
  echo $jsonStr;
}catch(PDOException $e)
{
  die("ERROR: {$e->getMessage()}");
}

?>