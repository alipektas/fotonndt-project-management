<?php
ob_start();
session_start();

include '../netting/baglan.php';

    $malzemesayiguncelle=$db->prepare("UPDATE foton_fieldtask_welding_materials SET
        welding_material_sid=:welding_material_sid,
        welding_material_quantity=:welding_material_quantity where welding_material_id=:welding_material_id");
    $update=$malzemesayiguncelle->execute(array(
        'welding_material_sid' => $_POST['welding_material_sid'],
        'welding_material_quantity' => $_POST['welding_material_quantity'],
        'welding_material_id' => $_POST['welding_material_id']
    ));
    if ($update)
    {
        $kaynakidsorgu=$db->prepare("SELECT * FROM foton_fieldtask_welding_materials where welding_material_id=:welding_material_id");
        $kaynakidsorgu->execute(array('welding_material_id' => $_POST['welding_material_id']));
        $kaynakidsorgucek=$kaynakidsorgu->fetch(PDO::FETCH_ASSOC);
        echo $kaynakidsorgucek['welding_material_wno'];
    }
    else
    {
        echo "no";
    }

?>

