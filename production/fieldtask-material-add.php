  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<!-- Bootstrap -->
<?php
ob_start();
session_start();
include '../netting/baglan.php';
$z = $_GET['kaynakno'];
$kaynaksor=$db->prepare("SELECT * FROM foton_fieldtask_weldings where fieldtask_welding_id=:fieldtask_welding_id and  fieldtask_welding_status=1 ");
$kaynaksor->execute(array('fieldtask_welding_id' => $z));
$kaynakcek=$kaynaksor->fetch(PDO::FETCH_ASSOC);
$usercheck=$db->prepare("SELECT * FROM foton_users where user_mail=:mail");
$usercheck->execute(array('mail' => $_SESSION['user_mail']));
$count=$usercheck->rowCount();
$userget=$usercheck->fetch(PDO::FETCH_ASSOC);
$malzemesor=$db->prepare("SELECT * FROM foton_materials WHERE material_status=1");
$malzemesor->execute();
/* izinsiz giriş için gerkli kod  */
if ($count==0)
{
  header("Location:login.php?durum=unaouthorized");
  exit;
}
?>

    <div id="ekleme">       

    <form  method="post" id="kaynakno-ekle" class="form-horizontal form-label-left input_mask">

<div class="col-md-2 col-sm-2 col-xs-4 form-group">

<div class="col-md-5 col-sm-5 col-xs-6 form-group">
<label>Malzeme</label>
  <select class="select2_single form-control" type="text" id="welding_material_sid" name="welding_material_sid"  required="required" class="form-control" >
    <option></option>
    <?php
    while($malzemecek=$malzemesor->fetch(PDO::FETCH_ASSOC))
    {?>
    <option value="<?php echo $malzemecek['material_id']?>"><?php echo $malzemecek['material_brand']?> <?php echo $malzemecek['material_dimension']?></option>
    <?php } ?>
  </select>
</div>

<div class="col-md-4 col-sm-4 col-xs-6 form-group">
            <label>Adet </label>
              <input type="number" id="welding_material_quantity" name="welding_material_quantity" class="form-control" >
            </div>

  <input type="hidden" name="welding_material_wno" value="<?php echo $z?>">
  <input type="hidden" name="welding_material_creator" value="<?php echo $userget['user_id']?>">

                      <div class="col-md-2 col-sm-2 col-xs-3"></div>

<div class="form-group">                        
                      <div class="col-md-6 col-sm-6 col-xs-12">
  <button type="button" id="malzeme-gonder" class="btn btn-primary malzemeekle">Ekle</button>
                      </div>
</div>

</form>


    </div>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
                <!-- Select2 -->
                <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Seçiniz",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->