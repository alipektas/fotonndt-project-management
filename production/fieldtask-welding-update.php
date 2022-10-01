<?php
ob_start();
session_start();

include '../netting/baglan.php';

    $malzemesayiguncelle=$db->prepare("UPDATE foton_fieldtask_weldings SET
        fieldtask_welding_no=:fieldtask_welding_no,
        fieldtask_welding_method=:fieldtask_welding_method,
        fieldtask_welding_size=:fieldtask_welding_size,
        fieldtask_welding_length=:fieldtask_welding_length,
        fieldtask_welding_welderno=:fieldtask_welding_welderno where fieldtask_welding_id=:fieldtask_welding_id");
    $update=$malzemesayiguncelle->execute(array(
        'fieldtask_welding_no' => $_POST['fieldtask_welding_no'],
        'fieldtask_welding_method' => $_POST['fieldtask_welding_method'],
        'fieldtask_welding_size' => $_POST['fieldtask_welding_size'],
        'fieldtask_welding_length' => $_POST['fieldtask_welding_length'],
        'fieldtask_welding_welderno' => $_POST['fieldtask_welding_welderno'],
        'fieldtask_welding_id' => $_POST['fieldtask_welding_id'],

    ));
    if ($update)
    {
        $kaynaksor=$db->prepare("SELECT * From foton_fieldtask_weldings where fieldtask_welding_id=:fieldtask_welding_id and fieldtask_welding_status=1");
        $kaynaksor->execute(array(
        
            'fieldtask_welding_id' => $_POST['fieldtask_welding_id']
        
        ));
        $kaynakcek=$kaynaksor->fetch(PDO::FETCH_ASSOC);
        $array=array(
            "fieldtask_welding_id3" => $kaynakcek['fieldtask_welding_id'],
            "fieldtask_welding_no3" => $kaynakcek['fieldtask_welding_no'],
            "fieldtask_welding_method3" => $kaynakcek['fieldtask_welding_method'],
            "fieldtask_welding_size3" => $kaynakcek['fieldtask_welding_size'],
            "fieldtask_welding_length3" => $kaynakcek['fieldtask_welding_length'],
            "fieldtask_welding_welderno3" => $kaynakcek['fieldtask_welding_welderno']
        );
        
        echo $json=json_encode($array);
    }
    else
    {
        echo "no";
    }

?>

