<?php include 'header.php'; 
//veri çekme işlemleri
$ayarsor=$db->prepare("SELECT * FROM site_ayar where ayar_id=:id");
$ayarsor->execute(array('id' => 0));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
?>

        <!-- page content -->
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2>Site Ayarları<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
    
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".1bs-example-modal-lg"><a  class="fa fa-plus-circle" style="color:#ffffff;"></i></a> Müşteri Ekle</button>
                     
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                      </div>
          <div class="row">
                  <div class="x_content">
                  <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Başlığı <span class="required">*</span>
  </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="text" id="first-name" name="ayar_title" value="<?php echo $ayarcek['ayar_title']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Açıklaması <span class="required">*</span>
  </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="text" id="first-name" name="ayar_description" value="<?php echo $ayarcek['ayar_description']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    <button  type="submit" name="siteayarkaydet" class="btn btn-success">Güncelle</button>
  </div>
</div>
</form>
                   
                      <!-- buranın üstü içerik divi --></div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>
        <!-- /page content -->
        <!-- /page content -->
   



<?php include 'footer.php'; ?>     




