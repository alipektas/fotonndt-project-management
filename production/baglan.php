<?php

try 

{
    $db=new PDO("mysql:localhost;dbname=foton;charset=utf8",'foton','123456');

} 


catch (PDOException $e)
{
  echo "baglanilamadi";
}




?>