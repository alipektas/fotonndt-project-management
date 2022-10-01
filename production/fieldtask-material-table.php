<?php
ob_start();
session_start();
include '../netting/baglan.php';
$z = $_GET['kaynakno'];
$malzemesor=$db->prepare("SELECT * FROM foton_fieldtask_welding_materials where welding_material_wno=:welding_material_wno and  welding_material_status=1 order by welding_material_id DESC");
$malzemesor->execute(array('welding_material_wno' => $z));
$usercheck=$db->prepare("SELECT * FROM foton_users where user_mail=:mail");
$usercheck->execute(array('mail' => $_SESSION['user_mail']));
$count=$usercheck->rowCount();
$userget=$usercheck->fetch(PDO::FETCH_ASSOC);
/* izinsiz giriş için gerkli kod  */
if ($count==0)
{
  header("Location:login.php?durum=unaouthorized");
  exit;
}
?>

<div id="test">                                   
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Filmler</th>
        <th width="20">Adet</th>
        <th width="20">Aksiyon</th>
      </tr>
  </thead>
    <tbody>
        <?php               
          while($malzemecek=$malzemesor->fetch(PDO::FETCH_ASSOC))
          {
            $anamalzemesor=$db->prepare("SELECT * FROM foton_materials where material_id=:material_id and material_status=1");
            $anamalzemesor->execute(array('material_id' => $malzemecek['welding_material_sid']));
            $anamalzemecek=$anamalzemesor->fetch(PDO::FETCH_ASSOC);
            ?>
      <tr>
        <td><?php echo $anamalzemecek['material_brand']?> <?php echo $anamalzemecek['material_dimension']?></td>
        <th>
          <?php echo $malzemecek['welding_material_quantity']?>
        </th>
        <td>
          <button type="button"  id="<?php echo $malzemecek['welding_material_id']?>" class="btn btn-success malzemegunbut">Düzenle</button>
          <button type="button" deger="<?php echo $anamalzemecek['material_brand']?>-<?php echo $anamalzemecek['material_dimension']?>" id="<?php echo $malzemecek['welding_material_id']?>" class="btn btn-danger malzemesil">Sil</button>
        </td>                                    
        
        
        </form>
      </tr>
        <?php } ?>
    </tbody>
      </table> 
    </div>
