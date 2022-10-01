<?php
ob_start();
session_start();

include 'baglan.php';

    $sahakaynakkaydet=$db->prepare("INSERT  INTO foton_fieldtask_weldings SET 
    fieldtask_welding_isno=:fieldtask_welding_isno,
    fieldtask_welding_no=:fieldtask_welding_no,
    fieldtask_welding_size=:fieldtask_welding_size,
    fieldtask_welding_method=:fieldtask_welding_method,
    fieldtask_welding_length=:fieldtask_welding_length,
    fieldtask_welding_welderno=:fieldtask_welding_welderno,
    fieldtask_welding_creator=:fieldtask_welding_creator,
    fieldtask_welding_date_creation=now(),
    fieldtask_welding_status=1");
    $insert=$sahakaynakkaydet->execute(array
    (
        'fieldtask_welding_isno' => $_POST['fieldtask_welding_isno'],
        'fieldtask_welding_no' => $_POST['fieldtask_welding_no'],
        'fieldtask_welding_size' => $_POST['fieldtask_welding_size'],
        'fieldtask_welding_method' => $_POST['fieldtask_welding_method'],
        'fieldtask_welding_length' => $_POST['fieldtask_welding_length'],
        'fieldtask_welding_welderno' => $_POST['fieldtask_welding_welderno'],
        'fieldtask_welding_creator' => $_POST['fieldtask_welding_creator']

    ));

    if ($insert)
    {
        $kaynaksor=$db->prepare("SELECT * FROM foton_fieldtask_weldings WHERE fieldtask_welding_status=1 order by fieldtask_welding_id DESC");
        $kaynaksor->execute();
        $kaynakcek=$kaynaksor->fetch(PDO::FETCH_ASSOC);

        
        $array=array(

            "fieldtask_welding_id" => $kaynakcek['fieldtask_welding_id'],
            "fieldtask_welding_no" => $kaynakcek['fieldtask_welding_no'],
            "fieldtask_welding_method" => $kaynakcek['fieldtask_welding_method'],
            "fieldtask_welding_size" => $kaynakcek['fieldtask_welding_size'],
            "fieldtask_welding_length" => $kaynakcek['fieldtask_welding_length'],
            "fieldtask_welding_welderno" => $kaynakcek['fieldtask_welding_welderno']

        
        );
        
        echo $json=json_encode($array);

    }
    else
    {
        echo "Ekleme Başarısız";
    }




?>

