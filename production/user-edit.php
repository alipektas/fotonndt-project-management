<?php include 'header.php'; 

// veri çekme işlemleri
$kullanicisor=$db->prepare("SELECT * FROM foton_users where user_id=:id");
$kullanicisor->execute(array('id' => $_GET['user_id']));
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
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
                    <h2>Kullanıcı Düzenleme</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                </div>
          <div class="row">
                  <div class="x_content">

                    <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı ID: <?php echo $kullanicicek['user_id']?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden"  name="user_id"  value="<?php echo $kullanicicek['user_id']?>"  class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="user_name" value="<?php echo $kullanicicek['user_name']?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Soyad <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="user_surname" value="<?php echo $kullanicicek['user_surname']?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-posta <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email"  name="user_mail" value="<?php echo $kullanicicek['user_mail']?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number"  name="user_phone" value="<?php echo $kullanicicek['user_phone']?>"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Eğitim Durumu</label>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <select name="user_education_status" class="form-control">
                            <option></option>
                            <option <?php if($kullanicicek['user_education_status'] == "İlkokul") :  ?> selected <?php endif; ?>>İlkokul</option>
                            <option <?php if($kullanicicek['user_education_status'] == "Lise") :  ?> selected <?php endif; ?>>Lise</option>
                            <option <?php if($kullanicicek['user_education_status'] == "Ön Lisans") :  ?> selected <?php endif; ?>>Ön Lisans</option>
                            <option <?php if($kullanicicek['user_education_status'] == "Lisans") :  ?> selected <?php endif; ?>>Lisans</option>
                            <option <?php if($kullanicicek['user_education_status'] == "Yüksek Lisans") :  ?> selected <?php endif; ?>>Yüksek Lisans</option>
                            <option <?php if($kullanicicek['user_education_status'] == "Doktora") :  ?> selected <?php endif; ?>>Doktora</option>

                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kullanıcı Tipi</label>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <select name="user_aut" required="required" class="form-control">
                            <option></option>
                            <option <?php if($kullanicicek['user_aut'] == "User") :  ?> selected <?php endif; ?>>User</option>
                            <option <?php if($kullanicicek['user_aut'] == "Admin") :  ?> selected <?php endif; ?>>Admin</option>
                            <option <?php if($kullanicicek['user_aut'] == "Müşteri") :  ?> selected <?php endif; ?>>Müşteri</option>

                          </select>
                        </div>
                      </div>
                      
                      <input type="hidden" name="user_lastupdater" value="<?php echo $userget['user_id']?>">

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="users.php"><button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                          <button type="submit" name="kullaniciguncelle" class="btn btn-success">Güncelle</button>
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