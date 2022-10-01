<?php include 'header.php'; 

// veri çekme işlemleri
$isemrisor=$db->prepare("SELECT * FROM foton_fieldtasks where fieldtask_id=:id and fieldtask_status=1");
$isemrisor->execute(array('id' => $_GET['fieldtask_id']));
$isemricek=$isemrisor->fetch(PDO::FETCH_ASSOC);


$cihazsor=$db->prepare("SELECT * FROM foton_equipment WHERE equipment_status=1");
$cihazsor->execute();
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
<style type="text/css">
    #durum1 {display: none;}
    #durum2 {display: none;}
</style>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="col-md-1 col-sm-1 col-xs-6">
              <div id="durum1" class="alert alert-success">
					Güncellendi.
              </div>
              <div id="durum2" class="alert alert-danger">
					Güncelleme başarısız.
              </div>
          </div>
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2>Görev Düzenleme<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
    

                     
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                </div>
          <div class="row">
                  <div class="x_content">

                  <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İş Emri No: <?php echo $_GET['fieldtask_id']?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden" id="first-name" name="fieldtask_id"  value="<?php echo $_GET['fieldtask_id']?>"  class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Müşteri<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select  type="text" class="select2_single form-control" name="fieldtask_customer" required="required">
      <?php 

while($mustericek=$musterisor->fetch(PDO::FETCH_ASSOC))
 
  
{?>

<option></option>
<option <?php if($mustericek['customer_id'] == $isemricek['fieldtask_customer']) :  ?> selected <?php endif; ?> value="<?php echo $mustericek['customer_id']?>"><?php echo $mustericek['customer_name']?></option>

<?php } ?>

    </select>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Müteahhit<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select  type="text" class="select2_single form-control" name="fieldtask_subcontractor" required="required">
      <?php 

while($muteahhitcek=$muteahhitsor->fetch(PDO::FETCH_ASSOC))
  
{?>
<option></option>
<option <?php if($muteahhitcek['customer_id'] == $isemricek['fieldtask_subcontractor']) :  ?> selected <?php endif; ?> value="<?php echo $muteahhitcek['customer_id']?>"><?php echo $muteahhitcek['customer_name']?></option>

<?php } ?>

    </select>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Proje No<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select  type="text" class="select2_single form-control" name="fieldtask_projectno" required="required">
      <?php 

while($projecek=$projesor->fetch(PDO::FETCH_ASSOC))
 
  
{?>

<option></option>
<option <?php if($projecek['project_id'] == $isemricek['fieldtask_projectno']) :  ?> selected <?php endif; ?> value="<?php echo $projecek['project_id']?>"><?php echo $projecek['project_no']?></option>

<?php } ?>

    </select>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasyon<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select  type="text" class="select2_single form-control" name="fieldtask_subcontractor_location" required="required">
      <?php 

while($lokasyoncek=$lokasyonsor->fetch(PDO::FETCH_ASSOC))
 
  
{?>
<option></option>
<option <?php if( $lokasyoncek['location_id'] == $isemricek['fieldtask_subcontractor_location']) :  ?> selected <?php endif; ?> value="<?php echo $lokasyoncek['location_id']?>"><?php echo $lokasyoncek['location_customer']?> <?php echo $lokasyoncek['location_name']?></option>

<?php } ?>

    </select>
  </div>
</div>



<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Saha Sorumlusu<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select type="text" class="select2_single form-control" name="fieldtask_personal_res" required="required">
      <?php 

while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC))
 
  
{?>
<option></option>
<option <?php if($kullanicicek['user_id'] == $isemricek['fieldtask_personal_res']) :  ?> selected <?php endif; ?> value="<?php echo $kullanicicek['user_id']?>"><?php echo $kullanicicek['user_name']?> <?php echo $kullanicicek['user_surname']?></option>

<?php } ?>

    </select>
  </div>
</div>

<div class="form-group">
<div class="control-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12">Görev Tarihi <span class="required">*</span></label>
<div class="col-md-3 col-sm-3 col-xs-12">
<input type="date" name="fieldtask_date_planned" value="<?php echo date("yyyy/dd/mm",strtotime($isemricek['fieldtask_date_planned'])); ?>" class="form-control col-md-7 col-xs-12">
  </div>
</div>
</div>


<input type="hidden" name="fieldtask_lastupdater" value="<?php echo $userget['user_id']?>">


<div class="ln_solid"></div>
<div class="form-group">
  <div align="right" class="col-md-6 col-sm-6 col-xs-12 ">
        <a href="fieldtasks.php"><button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
         <button type="submit" name="sahaplanguncelle" class="btn btn-primary">Kaydet</button>

  </div>
  <br />
</div>
</form>
                      <!-- buranın üstü içerik divi --></div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>
 <script>
$(function(){
	$("#ilce-select option").hide();
	$("#il-select").change(function(){
		$("#ilce-select option").hide();
		var slug = $("#il-select option:selected").attr("slug");
		if(slug){
			$("#ilce-select option[il-slug='"+slug+"']").show();
		}
	});
});



 $(function()
{

  $("#isemri-aktif-tablo").load("work-order-table.php");



    $("#yeni-isemri").click(function()
    {
      $("#isemri-aktif-tablo").fadeOut(500);
      $("#yeni-isemri-form").fadeIn(500);
      
      
    });
      
}
 )
</script>     

<script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: ".",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 10,
          placeholder: "En az bir personel seçmelisiniz.",
          allowClear: true
        });
      });
    </script>



<!-- /page content -->
<?php 
                         if ($_GET['status']=="updated") { ?>
                   <script>
                    $(function() {$("#durum1").fadeIn(500).delay(2000).fadeOut(500);});
                   </script>
                         <?php } 
                         
                         elseif($_GET['status']=="unsuccessful")
                         {?>                    <script>
                          $(function() {$("#durum2").fadeIn(500).delay(2000).fadeOut(500);});
                         </script>
                         <?php
                         } 
                         
                        ?>
        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->
