<?php
ob_start();
session_start();

include '../netting/baglan.php';

    $kaynaksil=$db->prepare("UPDATE foton_fieldtask_welding_materials SET 	welding_material_status=:deleted where welding_material_id=:welding_material_id");
    $update=$kaynaksil->execute(array('deleted' => 0, 'welding_material_id' => $_POST['welding_material_id']  ));
    if ($update)
    {
        echo "Silindi";
    }
    else
    {
        echo "Başarısız";
    }




?>