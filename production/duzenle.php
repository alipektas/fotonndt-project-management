<?php
ob_start();
session_start();

include 'baglan.php';

$kaynaksor=$db->prepare("SELECT * From foton_fieldtask_weldings where fieldtask_welding_id=:fieldtask_welding_id");
$kaynaksor->execute(array(

	'fieldtask_welding_id' => $_POST['fieldtask_welding_id']


));


$kaynakcek=$kaynaksor->fetch(PDO::FETCH_ASSOC);

//echo $bilgicek['bilgi_ad'];

$array=array(

    "fieldtask_welding_no" => $kaynakcek['fieldtask_welding_no'],
    "fieldtask_welding_size" => $kaynakcek['fieldtask_welding_size'],
    "fieldtask_welding_method" => $kaynakcek['fieldtask_welding_method'],
    "fieldtask_welding_welderno" => $kaynakcek['fieldtask_welding_welderno'],
    "fieldtask_welding_length" => $kaynakcek['fieldtask_welding_length'],
    "fieldtask_welding_id" => $kaynakcek['fieldtask_welding_id']

);

echo $json=json_encode($array);


?>