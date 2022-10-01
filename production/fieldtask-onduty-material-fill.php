<?php
ob_start();
session_start();

include 'baglan.php';

$kaynaksor=$db->prepare("SELECT * From foton_fieldtask_welding_materials where welding_material_id=:welding_material_id");
$kaynaksor->execute(array(

	'welding_material_id' => $_POST['welding_material_id']

));
$kaynakcek=$kaynaksor->fetch(PDO::FETCH_ASSOC);

$array=array(
    "welding_material_sid" => $kaynakcek['welding_material_sid'],
    "welding_material_quantity" => $kaynakcek['welding_material_quantity'],
);

echo $json=json_encode($array);


?>