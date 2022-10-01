<?php

try 

{
    $db=new PDO("mysql:host=localhost;dbname=foton;charset=utf8mb4",'root','123456');

} 


catch (PDOException $e)
{
  echo $e->getMessage();
}




?>