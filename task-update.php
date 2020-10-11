<?php 

require_once 'database.php';

try
{
  $id = $_POST['id'];
  $stm = $pdo->prepare("SELECT * FROM task WHERE id=?");
  $stm->execute([$id]);
  $json = $stm->fetch(PDO::FETCH_ASSOC);
  $jsonStr = json_encode($json);
  echo $jsonStr;
}catch(PDOException $e)
{
  die("ERROR: {$e->getMessage()}");
}

?>