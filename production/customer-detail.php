<?php include 'header.php'; 

$musterisor=$db->prepare("SELECT * FROM foton_customers where customer_id=:id");
$musterisor->execute(array('id' => $_GET['customer_id']));
$mustericek=$musterisor->fetch(PDO::FETCH_ASSOC);
if($userget['user_aut'] != "Admin")
{
  header("location: profile.php?status=izinsizgiris");
}
else{} 

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
                    <h2><b>Müşteri Düzenleme</b><small></small></h2>
                                            <ul class="nav navbar-right panel_toolbox">
    <li>
<?php 
                         if ($_GET['durum']=="ok") { ?>
                             <b style="color:green;">Güncellendi</b>
                         <?php } 
                         
                         elseif($_GET['durum']=="no")
                         {?> <b style="color:red;">İşlem Başarısız</b>
                         <?php
                         }
                        ?>
                     
                      </li>
                      
                    </ul>

                    <div class="clearfix"></div>
                        </div>
          <div class="row">
                  <div class="x_content">
                  <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Müşteri ID: <?php echo $mustericek['customer_id']?>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="hidden"  name="customer_id"  value="<?php echo $mustericek['customer_id']?>"  class="form-control col-md-7 col-xs-12">
  </div>
  </div>

  
  <div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Müşteri/Firma Adı <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text"  name="customer_name" value="<?php echo $mustericek['customer_name']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ünvan/Ticari Ad <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text"  name="customer_title" value="<?php echo $mustericek['customer_title']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-posta <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="email"  name="customer_mail" value="<?php echo $mustericek['customer_mail']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="number" name="customer_phone" value="<?php echo $mustericek['customer_phone']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" name="customer_adress" value="<?php echo $mustericek['customer_adress']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İlgili/Sorumlu Kişi </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" name="customer_picname" value="<?php echo $mustericek['customer_picname']?>" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İlgili/Sorumlu Kişi Ünvanı </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" name="customer_picname_title" value="<?php echo $mustericek['customer_picname_title']?>" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İlgil/Sorumlu Kişi Telefon </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="number" name="customer_picname_phone" value="<?php echo $mustericek['customer_picname_phone']?>" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İlgil/Sorumlu Kişi E-posta </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="email"  name="customer_picname_mail" value="<?php echo $mustericek['customer_picname_mail']?>" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vergi Dairesi <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" name="customer_tax_office" value="<?php echo $mustericek['customer_tax_office']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vergi Kimlik No <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="number" minlength=10  name="customer_tax_id" value="<?php echo $mustericek['customer_tax_id']?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Açıklama </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="first-name" name="customer_description" value="<?php echo $mustericek['customer_description']?>" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<input type="hidden" name="customer_lastupdater" value="<?php echo $userget['user_id']?>">

<div class="form-group">
  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
  <a href="customers.php"><button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
    <button type="submit" name="musteriguncelle" class="btn btn-success">Güncelle</button>
  </div>
</div>
</form>
            </div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>
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