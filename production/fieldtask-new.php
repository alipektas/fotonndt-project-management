<?php include 'header.php'; 

//tabloya veri çekme aliser
$cihazsor=$db->prepare("SELECT * FROM foton_equipment WHERE equipment_status=1");
$cihazsor->execute();
$isemrisor=$db->prepare("SELECT * FROM foton_workorder WHERE workorder_status=1");
$isemrisor->execute();
$musterisor=$db->prepare("SELECT * FROM foton_customers  where customer_status=1");
$musterisor->execute();
$muteahhitsor=$db->prepare("SELECT * FROM foton_customers  where customer_status=1");
$muteahhitsor->execute();
$kullanicisor=$db->prepare("SELECT * FROM foton_users  where user_status=1");
$kullanicisor->execute();
$lokasyonsor=$db->prepare("SELECT * FROM foton_locations  where location_status=1");
$lokasyonsor->execute();
$projesor=$db->prepare("SELECT * FROM foton_projects  where project_status=1");
$projesor->execute();


?>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2><b>Yeni Görev Planı</b><small></small></h2>

                    <div class="clearfix"></div>
            </div>
          <div class="row">
                  <div class="x_content">
                  <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


    <div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Firma <span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select id="musteri" type="text" class="select2_single form-control" name="fieldtask_customer" required="required">
      <option selected disabled></option>
      <?php 

while($mustericek=$musterisor->fetch(PDO::FETCH_ASSOC))
 
  
{?>
<option value="<?php echo $mustericek['customer_id']?>"><?php echo $mustericek['customer_name']?></option>

<?php } ?>

    </select>
  </div>
</div>


<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Saha Sorumlusu<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select type="text" class="select2_single form-control" name="fieldtask_personal_res" required="required">
      <option></option>
      <?php 

while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC))
 
  
{?>
<option value="<?php echo $kullanicicek['user_id']?>"><?php echo $kullanicicek['user_name']?> <?php echo $kullanicicek['user_surname']?></option>

<?php } ?>

    </select>
  </div>
</div>



<input type="hidden" name="fieldtask_creator" value="<?php echo $userget['user_id']?>">


<div class="ln_solid"></div>
<div class="form-group">
  <div align="right" class="col-md-6 col-sm-6 col-xs-12 ">
        <a href="fieldtasks.php"><button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
         <button type="submit" name="sahakayit" class="btn btn-primary">Kaydet</button>

  </div>
  <br />
</div>
</form>
            </div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>
<script>
$('#musteri').change(function(){
        $('#projeno option').hide();
        $('#projeno option[musteri="'+$(this).val()+'"]').show();
        if ($('#projeno option[value="' + $(this).val() + '"]').length) {
    $('#projeno option[musteri="' + $(this).val() + '"]').first().prop('selected', true);
  }
  else {
    $('#projeno').val('');
}});

$('#muteahhit').change(function(){
        $('#lokasyon option').hide();
        $('#lokasyon option[muteahhit="'+$(this).val()+'"]').show();
        if ($('#lokasyon option[value="' + $(this).val() + '"]').length) {
    $('#lokasyon option[muteahhit="' + $(this).val() + '"]').first().prop('selected', true);
  }
  else {
    $('#lokasyon').val('');
}});

</script>






 <?php include 'footer.php'; ?>