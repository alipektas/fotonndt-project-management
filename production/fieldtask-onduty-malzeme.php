<?php
ob_start();
session_start();

include '../netting/baglan.php';

    $malzemeekle=$db->prepare("INSERT INTO foton_fieldtask_welding_materials SET
        welding_material_wno=:welding_material_wno,
        welding_material_sid=:welding_material_sid,
        welding_material_quantity=:welding_material_quantity,
        welding_material_creator=:welding_material_creator,
        welding_material_date_created=now(),
        welding_material_status=1 ");
    $update=$malzemeekle->execute(array(
        'welding_material_wno' => $_POST['welding_material_wno'],
        'welding_material_sid' => $_POST['welding_material_sid'],
        'welding_material_quantity' => $_POST['welding_material_quantity'],
        'welding_material_creator' => $_POST['welding_material_creator']));
    if ($update)
    {
        echo $_POST['welding_material_wno'];
    }
    else
    {
        echo "Başarısız";
    }

?>

