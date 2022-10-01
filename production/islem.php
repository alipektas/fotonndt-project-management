<?php
ob_start();
session_start();

include 'baglan.php';
//site ayarlarını güncelleme
if (isset($_POST['siteayarkaydet']))
{
 $ayarkaydet=$db->prepare("UPDATE site_ayar SET ayar_title=:ayar_title, ayar_description=:ayar_description WHERE ayar_id=0");
 $update=$ayarkaydet->execute(array('ayar_title' => $_POST['ayar_title'], 'ayar_description' => $_POST['ayar_description']));

if ($update)
{
    header("Location:../production/site-ayar.php?status=successful");
}
else
{
    header("Location:../production/site-ayar.php?status=unsuccessful");
}
}

//kullanıcı girişleri
if (isset($_POST['userlogin']))
{
   $user_mail=$_POST['user_mail'];
   $user_pass=md5($_POST['user_pass']);
    $usercheck=$db->prepare("SELECT * FROM foton_users where user_mail=:mail and user_pass=:pass");
    $usercheck->execute(array('mail' => $user_mail, 'pass' => $user_pass));
    
 $count=$usercheck->rowCount();

/**/

    if ($count==1) {
        
        $_SESSION['user_mail']=$user_mail;
        header("Location:../production/profile.php");
        exit;

    } else {
            header("Location:../production/login.php?status=no");
            exit;
    } 
}



//müşteri kayıt aliser
if (isset($_POST['musterikayit']))
{

//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği
 $musterisor=$db->prepare("SELECT * FROM foton_customers where customer_name=:customer_name and customer_status=1");
 $musterisor->execute(array('customer_name' => $_POST['customer_name'] ));
 $musterisay=$musterisor->rowCount();

if ($musterisay==0)
{
    $musterikaydet=$db->prepare("INSERT INTO foton_customers SET 
    customer_name=:customer_name, 
    customer_title=:customer_title,  
    customer_mail=:customer_mail, 
    customer_phone=:customer_phone, 
    customer_adress=:customer_adress, 
    customer_picname=:customer_picname, 
    customer_picname_title=:customer_picname_title, 
    customer_picname_phone=:customer_picname_phone, 
    customer_picname_mail=:customer_picname_mail,
    customer_tax_office=:customer_tax_office, 
    customer_tax_id=:customer_tax_id, 
    customer_description=:customer_description, 
    customer_creator=:customer_creator,
    customer_date_creation=now(), 
    customer_status=1");

    $insert=$musterikaydet->execute(array(
        'customer_name' => $_POST['customer_name'], 
        'customer_title' => $_POST['customer_title'], 
        'customer_mail' => $_POST['customer_mail'], 
        'customer_phone' => $_POST['customer_phone'], 
        'customer_adress' => $_POST['customer_adress'], 
        'customer_picname' => $_POST['customer_picname'], 
        'customer_picname_title' => $_POST['customer_picname_title'], 
        'customer_picname_phone' => $_POST['customer_picname_phone'], 
        'customer_picname_mail' => $_POST['customer_picname_mail'],
        'customer_tax_office' => $_POST['customer_tax_office'], 
        'customer_tax_id' => $_POST['customer_tax_id'], 
        'customer_description' => $_POST['customer_description'], 
        'customer_creator' => $_POST['customer_creator'], 
    ));
    

if ($insert)
{
    header("Location:../production/customers.php?status=registrationsuccessful");
}
else
{
    header("Location:../production/customers.php?status=unsuccessful");
}
}

else
{
    header("Location:../production/customers.php?status=customerexist");
}

}


/*müşteri düzenleme aliser
if (isset($_GET['musteri_id']))

{
    $cid=$_GET['musteri_id'];
        header("Location:../production/customers.php?cid=$cid#");
    exit;

}
*/

//* kullanıcı kayıt
if (isset($_POST['userkayit']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği

 $user_pass=md5($_POST['user_pass']);

 $kullanicisor=$db->prepare("SELECT * FROM foton_users where user_mail=:user_mail and user_status=1");
 $kullanicisor->execute(array('user_mail' => $_POST['user_mail'] ));
 $kullanicisay=$kullanicisor->rowCount();

 if($kullanicisay ==0)
 {
    $kullanicikaydet=$db->prepare("INSERT INTO foton_users SET user_date=now(), user_name=:user_name, user_surname=:user_surname, user_mail=:user_mail, user_phone=:user_phone, user_pass=:user_pass, user_education_status=:user_education_status, user_aut=:user_aut, user_creator=:user_creator, user_status=1");
    $insert=$kullanicikaydet->execute(array
    (
        'user_name' => $_POST['user_name'],
        'user_surname' => $_POST['user_surname'],
        'user_mail' => $_POST['user_mail'],
        'user_phone' => $_POST['user_phone'],
        'user_pass' => $user_pass,
        'user_education_status' => $_POST['user_education_status'],
        'user_creator' => $_POST['user_creator'],
        'user_aut' => $_POST['user_aut'],

    ));
    

if ($insert)
{
    header("Location:../production/users.php?status=registrationsuccessful");
}
else
{
    header("Location:../production/users.php?status=unsuccessful");
}
}
else
{
  header("Location:../production/users.php?status=usermailexist");

}
}

//kullanıcı güncelleme aliser
if (isset($_POST['kullaniciguncelle']))
{
 $userguncelle=$db->prepare("UPDATE foton_users SET 
    user_name=:user_name, 
    user_surname=:user_surname, 
    user_mail=:user_mail,
    user_phone=:user_phone, 
    user_education_status=:user_education_status, 
    user_aut=:user_aut,
    user_lastupdater=:user_lastupdater  
        WHERE user_id=:user_id");
 $update=$userguncelle->execute(array(
        'user_name' => $_POST['user_name'],
        'user_surname' => $_POST['user_surname'],
        'user_mail' => $_POST['user_mail'],
        'user_phone' => $_POST['user_phone'],
        'user_education_status' => $_POST['user_education_status'],
        'user_aut' => $_POST['user_aut'],
        'user_lastupdater' => $_POST['user_lastupdater'],
        'user_id' => $_POST['user_id']
       ));

if ($update)
{
    header("Location:../production/user-edit.php?user_id={$_POST['user_id']}&status=updated");
}
else
{
    header("Location:../production/user-edit.php?user_id={$_POST['user_id']}&status=unsuccessful");
}
}


//kullanıcı düzenle git aliser
if (isset($_POST['kullaniciduzenlegit']))
{

   $userid = $_POST['user_id'];
    header("Location:../production/user-edit.php?user_id=$userid");

}

//* kullanıcı silme işlemi aliser
if (isset($_POST['kullanicisil']))
{
  $kullanicisil=$db->prepare("UPDATE foton_users SET user_status=0 where user_id=:user_id");
  $kontrol=$kullanicisil->execute(array(
    'user_id' => $_POST['user_id']
  ));

  if($kontrol)
  {
    header("location:../production/users.php?status=deleted");
   
  }
  else
  {
    header("location:../production/users.php?status=unsuccessful");

  }
}
//müşteri düzenlemeye git aliser
if (isset($_POST['musteriduzenlegit']))
{

   $musteriid = $_POST['customer_id'];
    header("Location:../production/customer-detail.php?customer_id=$musteriid");

}


//müşteri güncelleme aliser
if (isset($_POST['musteriguncelle']))
{
    $customer_id=$_POST['customer_id'];
 $musteriguncelle=$db->prepare("UPDATE foton_customers SET 
    customer_name=:customer_name,
    customer_title=:customer_title, 
    customer_mail=:customer_mail, 
    customer_phone=:customer_phone,
    customer_adress=:customer_adress,
    customer_picname=:customer_picname,
    customer_picname_title=:customer_picname_title,
    customer_picname_phone=:customer_picname_phone,
    customer_picname_mail=:customer_picname_mail,
    customer_tax_office=:customer_tax_office,
    customer_tax_id=:customer_tax_id,
    customer_description=:customer_description,
    customer_lastupdater=:customer_lastupdater  
        WHERE customer_id={$_POST['customer_id']}");
 $update=$musteriguncelle->execute(array(
        'customer_name' => $_POST['customer_name'],
        'customer_title' => $_POST['customer_title'],
        'customer_mail' => $_POST['customer_mail'],
        'customer_phone' => $_POST['customer_phone'],
        'customer_adress' => $_POST['customer_adress'],
        'customer_picname' => $_POST['customer_picname'],
        'customer_picname_title' => $_POST['customer_picname_title'],
        'customer_picname_phone' => $_POST['customer_picname_phone'],
        'customer_picname_mail' => $_POST['customer_picname_mail'],
        'customer_tax_office' => $_POST['customer_tax_office'],
        'customer_tax_id' => $_POST['customer_tax_id'],
        'customer_description' => $_POST['customer_description'],
        'customer_lastupdater' => $_POST['customer_lastupdater'] 
       ));

if ($update)
{
    header("Location:../production/customer-detail.php?customer_id={$_POST['customer_id']}&status=updated");
}
else
{
    header("Location:../production/customer-detail.php?customer_id={$_POST['customer_id']}&status=unsuccessful");
}
}

//cihaz kayıt aliser
if (isset($_POST['cihazkayit']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği

 $cihazsor=$db->prepare("SELECT * FROM foton_equipment where equipment_serial=:equipment_serial and equipment_status=1");
 $cihazsor->execute(array('equipment_serial' => $_POST['equipment_serial']));
 $say=$cihazsor->rowCount();

if ($say==0)
{
    $cihazkaydet=$db->prepare("INSERT INTO foton_equipment SET 
    equipment_serial=:equipment_serial, 
    equipment_model=:equipment_model, 
    equipment_creator=:equipment_creator,
    equipment_date=now(),
    equipment_status=1");
    $insert=$cihazkaydet->execute(array
    (
        'equipment_serial' => $_POST['equipment_serial'],
        'equipment_model' => $_POST['equipment_model'],
        'equipment_creator' => $_POST['equipment_creator']

    ));
    

if ($insert)
{
    header("Location:../production/equipment.php?status=successful");
}
else
{
    header("Location:../production/equipment.php?status=unsuccessful");
}
}

else
{
    header("Location:../production/equipment.php?status=exist");
}

}

//* cihaz silme işlemi aliser
if (isset($_POST['cihazsil']))
{
$cihazsil=$db->prepare("UPDATE foton_equipment SET equipment_status=0 where equipment_id={$_POST['equipment_id']}");
  $kontrol=$cihazsil->execute(array());

  if($kontrol)
  {
    header("location:../production/equipment.php?status=deleted");
   
  }
  else
  {
    header("location:../production/equipment.php?status=unsuccessful");

  }


}

//cihaz düzenlemeye git aliser
if (isset($_POST['cihazduzenlegit']))
{

   $cihazid = $_POST['equipment_id'];
    header("Location:../production/equipment-edit.php?equipment_id=$cihazid");

}


//cihaz güncelleme aliser
if (isset($_POST['cihazguncelle']))
{
 $cihazguncelid = $_POST['equipment_id'];
 $cihazguncelle=$db->prepare("UPDATE foton_equipment SET equipment_serial=:equipment_serial, equipment_model=:equipment_model where equipment_id={$_POST['equipment_id']}");
 $update=$cihazguncelle->execute(array('equipment_serial' => $_POST['equipment_serial'], 'equipment_model' => $_POST['equipment_model']));

if ($update)
{
    header("Location:../production/equipment-edit.php?equipment_id=$cihazguncelid&status=updated");
}
else
{
    header("Location:../production/equipment.php?equipment_id=$cihazguncelid&status=unsuccessful");
}
}

//* lokasyon kayıt aliser
if (isset($_POST['lokasyonkayit']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği

    $lokasyonkaydet=$db->prepare("INSERT INTO foton_locations SET 
    location_customer=:location_customer,
    location_name=:location_name, 
    location_adress=:location_adress,
    location_creator=:location_creator,
    location_date=now(),
    location_status=:location_status");
    $insert=$lokasyonkaydet->execute(array
    (
        'location_customer' => $_POST['location_customer'],
        'location_name' => $_POST['location_name'],
        'location_adress' => $_POST['location_adress'],
        'location_creator' => $_POST['location_creator'],
        'location_status' => 1,

    ));
    

if ($insert)
{
    header("Location:../production/locations.php?status=successful");
}
else
{
    header("Location:../production/locations.php?status=unsuccessful");
}
}

//lokasyon düzenlemeye git aliser
if (isset($_POST['lokasyonduzenlegit']))
{

   $lokid = $_POST['location_id'];
    header("Location:../production/location-edit.php?location_id=$lokid");

}

//lokasyon güncelleme aliser
if (isset($_POST['lokasyonguncelle']))
{
  $lokid = $_POST['location_id'];
 $lokasyonguncelle=$db->prepare("UPDATE foton_locations SET 
  location_customer=:location_customer,
  location_name=:location_name,
  location_adress=:location_adress, 
  location_lastupdater=:location_lastupdater where location_id=:location_id");
 $update=$lokasyonguncelle->execute(array(
   'location_customer' => $_POST['location_customer'], 
   'location_name' => $_POST['location_name'],
   'location_adress' => $_POST['location_adress'],
   'location_lastupdater' => $_POST['location_lastupdater'],
   'location_id' => $_POST['location_id']

  ));

if ($update)
{
    header("Location:../production/location-edit.php?location_id=$lokid&status=updated");
}
else
{
    header("Location:../production/location-edit.php?location_id=$lokid&status=unsuccessful");
}
}


//* lokasyon silme işlemi aliser
if (isset($_POST['lokasyonsil']))
{
  $lokasyonsil=$db->prepare("UPDATE foton_locations SET location_status=:deleted where location_id=:location_id");
  $kontrol=$lokasyonsil->execute(array('deleted' => 0,'location_id' => $_POST['location_id']));

  if($kontrol)
  {
    header("location:../production/locations.php?status=deleted");
   
  }
  else
  {
    header("location:../production/locations.php?status=unsuccessful");

  }


}

//* müşteri silme işlemi aliser
if (isset($_POST['musterisil'])) 
{
    



 
  $customerdelete=$db->prepare("UPDATE foton_customers SET customer_status=:deleted2 WHERE customer_id=:customer_id");
  $kontrol=$customerdelete->execute(array('deleted2' => 0, 'customer_id' => $_POST['customer_id']));


  if($kontrol)
  {  
    $muslokasyonsil=$db->prepare("UPDATE foton_locations SET location_status=:deleted where location_customer=:location_customer");
  $kontrol2=$muslokasyonsil->execute(array('deleted' => 0,'location_customer' => $_POST['customer_name']));
    
    if($kontrol2)
    {
      header("location:../production/customers.php?status=deleted");
    }

    else
    {
      header("location:../production/customers.php?status=locations-couldntdeleted");
    }
   
  }
  else
  {
    header("location:../production/customers.php?status=unsuccessful");

  }


}




//* malzeme kayıt aliser
if (isset($_POST['malzemekayit']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği



    $malzemekaydet=$db->prepare("INSERT INTO foton_materials SET 
    material_type=:material_type, 
    material_brand=:material_brand,
    material_description=:material_description, 
    material_creator=:material_creator,
    material_date=now(), 
    material_status=1 ");
    $insert=$malzemekaydet->execute(array
    (
        'material_type' => $_POST['material_type'],
        'material_brand' => $_POST['material_brand'],
        'material_description' => $_POST['material_description'],
        'material_creator' => $_POST['material_creator']
        

    ));
    
if ($insert)
{
  $malzemesor=$db->prepare("SELECT * FROM foton_materials WHERE material_status=1 order by material_id DESC");
  $malzemesor->execute();
  $malzemecek=$malzemesor->fetch(PDO::FETCH_ASSOC);

    $stokkaydet=$db->prepare("INSERT INTO foton_material_stocks SET 
    stock_id=:stock_id, 
    stock_status=1 ");
    $insert=$stokkaydet->execute(array
    (
        'stock_id' => $malzemecek['material_id'] 
    ));

    header("Location:../production/materials.php?status=successful");
}
else
{
    header("Location:../production/materials.php?status=unsuccessful");
}
}

//malzeme düzenlemeye git aliser
if (isset($_POST['malzemeduzenlegit']))
{

   $malzemeid = $_POST['material_id'];
    header("Location:../production/material-edit.php?material_id=$malzemeid");

}

//malzeme güncelleme aliser
if (isset($_POST['malzemeguncelle']))
{
 $malzemeguncelid = $_POST['material_id'];
 $malzemeguncelle=$db->prepare("UPDATE foton_materials SET material_type=:material_type, material_brand=:material_brand, material_description=:material_description  where material_id={$_POST['material_id']}");
 $update=$malzemeguncelle->execute(array('material_type' => $_POST['material_type'], 'material_brand' => $_POST['material_brand'], 'material_description' => $_POST['material_description']));

if ($update)
{
    header("Location:../production/material-edit.php?material_id=$malzemeguncelid&status=updated");
}
else
{
    header("Location:../production/material-edit.php?material_id=$malzemeguncelid&status=unsuccessful");
}
}

//* malzeme silme işlemi aliser
if (isset($_POST['malzemesil']))
{
  $malzemesil=$db->prepare("UPDATE foton_materials SET material_status=0 where material_id=:material_id");
  $kontrol=$malzemesil->execute(array('material_id' => $_POST['material_id']));

  if($kontrol)
  {
    header("location:../production/materials.php?status=deleted");
   
  }
  else
  {
    header("location:../production/materials.php?status=unsuccessful");

  }
}

//* araç kayıt aliser
if (isset($_POST['arackayit']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği

    $arackaydet=$db->prepare("INSERT INTO foton_vehicles SET 
    vehicle_plaka=:vehicle_plaka,
    vehicle_model=:vehicle_model, 
    vehicle_creator=:vehicle_creator,
    vehicle_status=1 ");
    $insert=$arackaydet->execute(array
    (
        'vehicle_plaka' => $_POST['vehicle_plaka'],
        'vehicle_model' => $_POST['vehicle_model'],
        'vehicle_creator' => $_POST['vehicle_creator']
    ));
    

if ($insert)
{
    header("Location:../production/vehicles.php?status=successful");
}
else
{
    header("Location:../production/vehicles.php?status=unsuccessful");
}
}

//araç düzenlemeye git aliser
if (isset($_POST['aracduzenlegit']))
{

   $aracid = $_POST['vehicle_id'];
    header("Location:../production/vehicle-edit.php?vehicle_id=$aracid");

}

//araç güncelleme aliser
if (isset($_POST['aracguncelle']))
{
 $aracguncelid = $_POST['vehicle_id'];
 $aracguncelle=$db->prepare("UPDATE foton_vehicles SET vehicle_plaka=:vehicle_plaka, vehicle_model=:vehicle_model where vehicle_id={$_POST['vehicle_id']}");
 $update=$aracguncelle->execute(array('vehicle_plaka' => $_POST['vehicle_plaka'], 'vehicle_model' => $_POST['vehicle_model']));

if ($update)
{
    header("Location:../production/vehicle-edit.php?vehicle_id=$aracguncelid&status=updated");
}
else
{
    header("Location:../production/vehicle-edit.php?vehicle_id=$aracguncelid&status=unsuccessful");
}
}

//* araç silme işlemi aliser
if (isset($_POST['aracsil']))
{
  $aracsil=$db->prepare("UPDATE foton_vehicles SET vehicle_status=0 where vehicle_id=:vehicle_id");
  $kontrol=$aracsil->execute(array('vehicle_id' => $_POST['vehicle_id']));

  if($kontrol)
  {
    header("location:../production/vehicles.php?status=deleted");
   
  }
  else
  {
    header("location:../production/vehicles.php?status=unsuccessful");

  }


}



//* depo kayıt aliser
if (isset($_POST['depokayit']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği

    $depokaydet=$db->prepare("INSERT INTO foton_warehouses SET 
    warehouse_name=:warehouse_name,
    warehouse_type=:warehouse_type,
    warehouse_adress=:warehouse_adress, 
    warehouse_creator=:warehouse_creator,
    warehouse_date=now(),
    warehouse_status=1 ");
    $insert=$depokaydet->execute(array
    (
        'warehouse_name' => $_POST['warehouse_name'],
        'warehouse_type' => $_POST['warehouse_type'],
        'warehouse_adress' => $_POST['warehouse_adress'],
        'warehouse_creator' => $_POST['warehouse_creator']
    ));
    

if ($insert)
{
    header("Location:../production/warehouses.php?status=successful");
}
else
{
    header("Location:../production/warehouses.php?status=unsuccessful");
}
}

//depo düzenlemeye git aliser
if (isset($_POST['depoduzenlegit']))
{

   $depoid = $_POST['warehouse_id'];
    header("Location:../production/warehouse-edit.php?warehouse_id=$depoid");

}

//depo güncelleme aliser
if (isset($_POST['depoguncelle']))
{
 $depoguncelid = $_POST['warehouse_id'];
 $depoguncelle=$db->prepare("UPDATE foton_warehouses SET warehouse_name=:warehouse_name, warehouse_type=:warehouse_type, warehouse_adress=:warehouse_adress where warehouse_id={$_POST['warehouse_id']}");
 $update=$depoguncelle->execute(array('warehouse_name' => $_POST['warehouse_name'], 'warehouse_type' => $_POST['warehouse_type'], 'warehouse_adress' => $_POST['warehouse_adress']));

if ($update)
{
    header("Location:../production/warehouse-edit.php?warehouse_id=$depoguncelid&status=updated");
}
else
{
    header("Location:../production/warehouse-edit.php?warehouse_id=$depoguncelid&status=unsuccessful");
}
}

//* depo silme işlemi aliser
if (isset($_POST['deposil']))
{
  $deposil=$db->prepare("UPDATE foton_warehouses SET warehouse_status=0 where warehouse_id=:warehouse_id");
  $kontrol=$deposil->execute(array('warehouse_id' => $_POST['warehouse_id']));

  if($kontrol)
  {
    header("location:../production/warehouses.php?status=deleted");
   
  }
  else
  {
    header("location:../production/warehouses.php?status=unsuccessful");

  }


}
 
//* saha kayıt aliser
if (isset($_POST['sahakayit']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği
//$d2 = new Datetime("now");
    $sahakaydet=$db->prepare("INSERT INTO foton_fieldtasks SET 
    fieldtask_customer=:fieldtask_customer,
    fieldtask_subcontractor=:fieldtask_subcontractor,
    fieldtask_projectno=:fieldtask_projectno,
/*    fieldtask_subcontractor_location=:fieldtask_subcontractor_location, */
    fieldtask_personal_res=:fieldtask_personal_res,
    fieldtask_date_planned=:fieldtask_date_planned, 
    fieldtask_creator=:fieldtask_creator,
    fieldtask_date_created=now(),
    fieldtask_status=1 ");
    $insert=$sahakaydet->execute(array
    (
        'fieldtask_customer' => $_POST['fieldtask_customer'],
        'fieldtask_subcontractor' => $_POST['fieldtask_subcontractor'],
        'fieldtask_projectno' => $_POST['fieldtask_projectno'],
      /*  'fieldtask_subcontractor_location' => $_POST['fieldtask_subcontractor_location'], */
        'fieldtask_personal_res' => $_POST['fieldtask_personal_res'],
        'fieldtask_date_planned' => $_POST['fieldtask_date_planned'],
        'fieldtask_creator' => $_POST['fieldtask_creator']
    ));
    

if ($insert)
{
    header("Location:../production/fieldtasks.php?status=successful");
}
else
{
    header("Location:../production/fieldtask-new.php?status=unsuccessful");
}
}

//* saha plan silme işlemi aliser
if (isset ($_POST['sahaplansil'])) 
{
  $sahaplansil=$db->prepare("UPDATE foton_fieldtasks SET fieldtask_status=0 where fieldtask_id=:fieldtask_id");
  $kontrol=$sahaplansil->execute(array('fieldtask_id' => $_POST['fieldtask_id']));

  if($kontrol)
  {
    header("location:../production/fieldtasks.php?status=deleted");
   
  }
  else
  {
    header("location:../production/fieldtasks.php?status=unsuccessful");

  }


}


//saha plan düzenlemeye git aliser
if (isset($_POST['sahaplanduzenle']))
{

   $sahaplanid = $_POST['fieldtask_id'];
    header("Location:../production/fieldtask-edit.php?fieldtask_id=$sahaplanid");



}

//* saha plan güncelle aliser
if (isset($_POST['sahaplanguncelle']))
{
  $sahaplanid = $_POST['fieldtask_id'];

  $sahaplanguncelleme=$db->prepare("UPDATE foton_fieldtasks SET 
  fieldtask_customer=:fieldtask_customer,
  fieldtask_subcontractor=:fieldtask_subcontractor,
  fieldtask_projectno=:fieldtask_projectno,
  fieldtask_subcontractor_location=:fieldtask_subcontractor_location,
  fieldtask_personal_res=:fieldtask_personal_res,
  fieldtask_lastupdater=:fieldtask_lastupdater where fieldtask_id=:fieldtask_id");
  $kontrolet=$sahaplanguncelleme->execute(array(

    'fieldtask_customer' => $_POST['fieldtask_customer'],
    'fieldtask_subcontractor' => $_POST['fieldtask_subcontractor'],
    'fieldtask_projectno' => $_POST['fieldtask_projectno'],
    'fieldtask_subcontractor_location' => $_POST['fieldtask_subcontractor_location'],
    'fieldtask_personal_res' => $_POST['fieldtask_personal_res'],
    'fieldtask_lastupdater' => $_POST['fieldtask_lastupdater'],
    'fieldtask_id' => $_POST['fieldtask_id']

    ));

  if($kontrolet)
  {

    header("location:../production/fieldtask-edit.php?fieldtask_id=$sahaplanid&status=updated");
   
  }
  else
  {
    header("location:../production/fieldtask-edit.php?fieldtask_id=$sahaplanid&status=unsuccessful");

  } 

}



//saha plan başlatma aliser
if (isset($_POST['sahaplanbaslat']))
{

   $sahagorevid = $_POST['fieldtask_id'];
    header("Location:../production/fieldtask-activation.php?id=$sahagorevid");



}



//* dsaha görevi aktif işlemi aliser
if (isset($_POST['sahaaktif']))
{
  $d2 = new Datetime("now");
  $colors =$_POST['fieldtask_welding_geometry'];
  $team = $_POST['fieldtask_personal_team'];
  $data = json_encode($colors, true);
  $data2 = json_encode($team, true);

  $sahagorevaktif=$db->prepare("UPDATE foton_fieldtasks SET 
  fieldtask_equipment=:fieldtask_equipment,
  fieldtask_equipment_energylevel=:fieldtask_equipment_energylevel,
  fieldtask_activecoresize=:fieldtask_activecoresize,
  fieldtask_welding_method=:fieldtask_welding_method,
  fieldtask_welding_geometry=:fieldtask_welding_geometry,
  fieldtask_vehicle=:fieldtask_vehicle,
  fieldtask_personal_bgeolocation_latitude=:fieldtask_personal_bgeolocation_latitude,
  fieldtask_personal_bgeolocation_longitude=:fieldtask_personal_bgeolocation_longitude,
  fieldtask_date_start=now(),
  fieldtask_personal_team=:fieldtask_personal_team,
  fieldtask_lastupdater=:fieldtask_lastupdater,
  
  fieldtask_status=2 where fieldtask_id=:fieldtask_id");
  $kontrol=$sahagorevaktif->execute(array(

    'fieldtask_equipment' => $_POST['fieldtask_equipment'],
    'fieldtask_equipment_energylevel' => $_POST['fieldtask_equipment_energylevel'],
    'fieldtask_activecoresize' => $_POST['fieldtask_activecoresize'],
    'fieldtask_welding_method' => $_POST['fieldtask_welding_method'],
    'fieldtask_personal_bgeolocation_latitude' => $_POST['fieldtask_personal_bgeolocation_latitude'],
    'fieldtask_personal_bgeolocation_longitude' => $_POST['fieldtask_personal_bgeolocation_longitude'],
    'fieldtask_welding_geometry' => $data,
    'fieldtask_vehicle' => $_POST['fieldtask_vehicle'],
    'fieldtask_personal_team' => $data2,
    'fieldtask_lastupdater' => $_POST['fieldtask_lastupdater'],
    'fieldtask_id' => $_POST['fieldtask_id']

    ));

  if($kontrol)
  {
    $fieldtaskid=$_POST['fieldtask_id']  ;
    header("location:../production/fieldtask-onduty.php?fieldtask_id=$fieldtaskid");
   
  }
  else
  {
    header("location:../production/fieldtasks.php?status=unsuccessful");

  } 

}

//* saha kaynakno kayıt aliser
if (isset($_POST['sahakaynaknokaydet']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği

    $sahamalzemekaydet=$db->prepare("INSERT INTO foton_fieldtask_materials SET 
    fieldtask_material_isno=:fieldtask_material_isno,
    fieldtask_material_weldingno=:fieldtask_material_weldingno,
    fieldtask_material_size=:fieldtask_material_size,
    fieldtask_material_thickness=:fieldtask_material_thickness,
    fieldtask_material_welderno=:fieldtask_material_welderno,
    fieldtask_material_image=:fieldtask_material_image,
    fieldtask_material_creator=:fieldtask_material_creator,
    fieldtask_material_status=1");
    $insert=$sahamalzemekaydet->execute(array
    (
        'fieldtask_material_isno' => $_POST['fieldtask_material_isno'],
        'fieldtask_material_weldingno' => $_POST['fieldtask_material_weldingno'],
        'fieldtask_material_size' => $_POST['fieldtask_material_size'],
        'fieldtask_material_thickness' => $_POST['fieldtask_material_thickness'],
        'fieldtask_material_welderno' => $_POST['fieldtask_material_welderno'],
        'fieldtask_material_image' => $_POST['fieldtask_material_image'],
        'fieldtask_material_creator' => $_POST['fieldtask_material_creator']

    ));
    

if ($insert)
{
    echo "kayıt başarılı";
}
else
{
    echo "kayıt başarısız";
}
}


//* saha bitirme işlemi aliser
if (isset($_POST['sahabitirme']))
{
  $d2 = new Datetime("now");
  $sahabitir=$db->prepare("UPDATE foton_fieldtasks SET 
  fieldtask_personal_egeolocation_latitude=:fieldtask_personal_egeolocation_latitude, 
  fieldtask_personal_egeolocation_longitude=:fieldtask_personal_egeolocation_longitude, 
  fieldtask_date_finish=now(),
  fieldtask_status=3 where fieldtask_id=:fieldtask_id");
  $kontrol=$sahabitir->execute(array('fieldtask_personal_egeolocation_latitude' => $_POST['fieldtask_personal_egeolocation_latitude'],
  'fieldtask_personal_egeolocation_longitude' => $_POST['fieldtask_personal_egeolocation_longitude'],'fieldtask_id' => $_POST['fieldtask_id']));

  if($kontrol)
  {
    header("location:../production/fieldtasks-archive.php");
   
  }
  else
  {
      $sahab=$_POST['fieldtask_id'];
    header("location:../production/fieldtask-onduty.php?fieldtask_id=$sahab&status=unsuccessful");

  }


}

//saha plan arşiv detay git aliser
if (isset($_POST['sahagorevarsiv']))
{

   $sahaarsivid = $_POST['fieldtask_id'];
    header("Location:../production/fieldtasks-archive-detail.php?fieldtask_id=$sahaarsivid");



}




//* proje kayıt aliser
if (isset($_POST['projekayit']))
{
//$customer_name=htmlspecialchars($_POST['customer_name']); kullanıcıdan gelecek script kodlarını engelleme örneği

    $projekaydet=$db->prepare("INSERT INTO foton_projects SET 
    project_customer=:project_customer,
    project_no=:project_no, 
    project_description=:project_description,
    project_creator=:project_creator,
    project_date_creation=now(),
    project_status=:project_status");
    $insert=$projekaydet->execute(array
    (
        'project_customer' => $_POST['project_customer'],
        'project_no' => $_POST['project_no'],
        'project_description' => $_POST['project_description'],
        'project_creator' => $_POST['project_creator'],
        'project_status' => 1

    ));
    

if ($insert)
{
    header("Location:../production/projects.php?status=successful");
}
else
{
    header("Location:../production/projects.php?status=unsuccessful");
}
}

//proje düzenleme gitme aliser
if (isset($_POST['projeduzenlegit']))
{

   $projectid = $_POST['project_id'];
    header("Location:../production/project-detail.php?project_id=$projectid");



}

//proje güncelleme
if (isset($_POST['projeguncelle']))
{
  $projectid = $_POST['project_id'];
 $projeguncelle=$db->prepare("UPDATE foton_projects SET project_date_lastupdate=now(), project_customer=:project_customer, project_no=:project_no, project_description=:project_description, project_lastupdater=:project_lastupdater where project_id=:project_id");
 $update=$projeguncelle->execute(array('project_customer' => $_POST['project_customer'], 'project_no' => $_POST['project_no'], 'project_description' => $_POST['project_description'], 'project_lastupdater' => $_POST['project_lastupdater'], 'project_id' => $_POST['project_id']));

if ($update)
{
  header("Location:../production/project-detail.php?project_id=$projectid&status=updated");
}
else
{
  header("Location:../production/project-detail.php?project_id=$projectid&status=unsuccessful");
}
}

//* proje silme işlemi aliser
if (isset ($_POST['projesil'])) 
{
  $projesil=$db->prepare("UPDATE foton_projects SET project_status=0 where project_id=:project_id");
  $kontrol=$projesil->execute(array('project_id' => $_POST['project_id']));

  if($kontrol)
  {
    header("location:../production/projects.php?status=deleted");
   
  }
  else
  {
    header("location:../production/projects.php?status=unsuccessful");

  }


}
?>

