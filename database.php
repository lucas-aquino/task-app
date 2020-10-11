<?php

  $serverName   = "localhost";
  $userName     = "root";
  $dbname       = "task-app";
  $password     = "";

  try
  {
    $pdo = new PDO("mysql:host={$serverName};dbname={$dbname}", $userName, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  }catch (PDOException $e)
  {
    echo "No se pudo conectar a la base de datos ERROR: {$e->getMessage()}";
  }


?>