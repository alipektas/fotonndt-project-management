<?php
ob_start();
session_start();

include 'baglan.php';

$kaynaksor=$db->prepare("SELECT * From foton_fieldtask_weldings where fieldtask_welding_id=:fieldtask_welding_id");
$kaynaksor->execute(array(

	'fieldtask_welding_id' => $_POST['fieldtask_welding_id']

));
$kaynakcek=$kaynaksor->fetch(PDO::FETCH_ASSOC);

$array=array(
    "fieldtask_welding_id2" => $kaynakcek['fieldtask_welding_id'],
    "fieldtask_welding_no2" => $kaynakcek['fieldtask_welding_no'],
    "fieldtask_welding_method2" => $kaynakcek['fieldtask_welding_method'],
    "fieldtask_welding_size2" => $kaynakcek['fieldtask_welding_size'],
    "fieldtask_welding_length2" => $kaynakcek['fieldtask_welding_length'],
    "fieldtask_welding_welderno2" => $kaynakcek['fieldtask_welding_welderno']
);

echo $json=json_encode($array);


?>