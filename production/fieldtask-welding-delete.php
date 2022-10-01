<?php
ob_start();
session_start();

include '../netting/baglan.php';

    $kaynaksil=$db->prepare("UPDATE foton_fieldtask_weldings SET fieldtask_welding_status=:deleted where fieldtask_welding_id=:fieldtask_welding_id");
    $update=$kaynaksil->execute(array('deleted' => 0, 'fieldtask_welding_id' => $_POST['fieldtask_welding_id']  ));

    $kaynakmalzemelerisil=$db->prepare("UPDATE foton_fieldtask_welding_materials SET 	welding_material_status=:deleted where welding_material_wno=:welding_material_wno");
    $update2=$kaynakmalzemelerisil->execute(array('deleted' => 0, 'welding_material_wno' => $_POST['fieldtask_welding_id']  ));

    if ($update)
    {
        echo "Silindi";
    }
    else
    {
        echo "Başarısız";
    }




?>