<?php include 'header.php'; 

$projesor=$db->prepare("SELECT * FROM foton_projects where project_id=:id");
$projesor->execute(array('id' => $_GET['project_id']));
$projecek=$projesor->fetch(PDO::FETCH_ASSOC);
$musterisor=$db->prepare("SELECT * FROM foton_customers  where customer_status=1");
$musterisor->execute();
?>
<style type="text/css">
    #durum1 {display: none;}
    #durum2 {display: none;}
</style>
        <!-- page content -->
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
            <h2><b>Proje Düzenleme</b><small></small></h2>
              <ul class="nav navbar-right panel_toolbox"><li> </li>
              </ul>
                    <div class="clearfix"></div>
                        </div>
          <div class="row">
                  <div class="x_content">
                  <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proje ID: <?php echo $projecek['project_id']?>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="hidden" name="project_id"  value="<?php echo $projecek['project_id']?>"  class="form-control col-md-7 col-xs-12">
  </div>
  </div>

  <div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Müşteri<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select  type="text" class="select2_single form-control" name="project_customer" required="required">
      <?php 

while($mustericek=$musterisor->fetch(PDO::FETCH_ASSOC))
 
  
{?>

<option></option>
<option <?php if($mustericek['customer_id'] == $projecek['project_customer']) :  ?> selected <?php endif; ?> value="<?php echo $mustericek['customer_id']?>"><?php echo $mustericek['customer_name']?></option>

<?php } ?>

    </select>
  </div>
</div>
  
  <div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proje No <span class="required">*</span>
  </label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input type="text" name="project_no" value="<?php echo $projecek['project_no']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Açıklama </label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input type="text"  name="project_description" value="<?php echo $projecek['project_description']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<input type="hidden" name="project_lastupdater" value="<?php echo $userget['user_id']?>">

<div class="form-group">
  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
  <a href="projects.php"><button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
    <button type="submit" name="projeguncelle" class="btn btn-success">Güncelle</button>
  </div>
</div>
</form>
            </div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>        <script>
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
        <!-- footer content -->
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
        <?php include 'footer.php'; ?>
        <!-- /footer content -->

