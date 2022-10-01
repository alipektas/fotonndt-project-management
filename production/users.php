<?php 

include 'header.php'; 
//tabloya veri çekme aliser

$kullanicisor=$db->prepare("SELECT * FROM foton_users WHERE user_status=1");
$kullanicisor->execute();
if($userget['user_aut'] != "Admin")
{
  header("location: profile.php?status=izinsizgiris");
}
else{}
?>
<style type="text/css">
    #durum1 {display: none;}
    #durum2 {display: none;}
    #durum3 {display: none;}
    #durum4 {display: none;}

</style>
        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-1 col-sm-1 col-xs-6">
              <div id="durum1" class="alert alert-success">
					Kullanıcı kayıt edildi.
              </div>
              <div id="durum2" class="alert alert-danger">
					Kayıt başarısız.
              </div>
              <div id="durum3" class="alert alert-warning">
					Aynı e-posta adresine kayıtlı kullanıcı mevcut.
              </div>
              <div id="durum4" class="alert alert-warning">
					Kullanıcı silindi.
              </div>
          </div>
          <div class="">
            <div class="clearfix"></div>
            <div class="row">                   
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><b>Kullanıcılar</b></button><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
    <li>
                    <button type="button" class="btn btn-round btn-dark" data-toggle="modal" data-target=".1bs-example-modal-lg"><a  class="fa fa-plus" style="color:#ffffff;"></i></a> Kullanıcı Ekle</button>
                     
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="row">
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Ad</th>
                          <th>Soyad</th>
                          <th>Mail</th>
                          <th>Kullanıcı tipi</th>
                          <th>Kayıt tarihi</th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody>
                      <script language="javascript">
                             function confirmDel() {
                                 var agree=confirm("Silmek istediğinizden emin misiniz?");
                              if (agree) {
                                  return true ; }
                           else {
                         return false ;}
                               }
                                  </script>         
                      <?php 
                      
                      while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC))

                      {?>

                        <tr>
                          <td><?php echo $kullanicicek['user_name']?></td>
                          <td><?php echo $kullanicicek['user_surname']?></td>
                          <td><?php echo $kullanicicek['user_mail']?></td>
                          <td><?php echo $kullanicicek['user_aut']?></td>
                          <td><?php echo $kullanicicek['user_date']?></td>
                          <td align="center" width="20">
                          <form action="../netting/islem.php" method="POST" >
                          <input type="hidden" name="user_id" value="<?php echo $kullanicicek['user_id']?>">
                          <button type="submit" name="kullaniciduzenlegit" class="btn btn-primary"><i class="fa fa-pencil"></i> Düzenle </button>
                          <button type="submit" name="kullanicisil" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-trash-o"></i> Sil </button>
                          </form>
                          </td>
                        </tr>

                      <?php    }
                      
                      
                      ?>
                      
                      

                        
                      </tbody>
                    </table>
                    
                    <!-- kullanıcı yeni kayıt -->
                    <div class="modal fade 1bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <center><h3 class="modal-title" id="myModalLabel">Yeni Kullanıcı Ekleme</h3></center>
                                </div>
                                <div class="modal-body">
                                <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="user_name"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Soyad<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="user_surname" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number"  name="user_phone"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-posta<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email"  name="user_mail" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şifre<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="user_pass" required="required" class="form-control col-md-7 col-xs-12">
                      <span  class="btn-show-pass">  </span>

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Eğitim Durumu</label>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <select name="user_education_status" class="form-control">
                            <option></option>
                            <option>İlkokul</option>
                            <option>Lise</option>
                            <option>Ön Lisans</option>
                            <option>Lisans</option>
                            <option>Yüksek Lisans</option>
                            <option>Doktora</option>

                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kullanıcı Tipi</label>
                        <div class="col-md-2 col-sm-9 col-xs-12">
                          <select name="user_aut" required="required" class="form-control">
                            <option></option>
                            <option>User</option>
                            <option>Admin</option>
                            <option>Müşteri</option>

                          </select>
                        </div>
                      </div>

                      <input type="hidden" name="user_creator" value="<?php echo $userget['user_id']?>">
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                               <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                               <button type="submit" name="userkayit" class="btn btn-primary">Kaydet</button>
                      
                        </div>
                        <br />
                      </div>
                    </form></div>


                                </div>
                                <div class="clearfix"></div>
                                </div>
                                </div>






                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
        <!-- /page content -->
        <?php 
                         if ($_GET['status']=="registrationsuccessful") { ?>
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
                         
                         elseif($_GET['status']=="usermailexist")
                         { ?>                    <script>
                          $(function() {$("#durum3").fadeIn(500).delay(2000).fadeOut(500);});
                         </script>
                         <?php
                         }
                         elseif($_GET['status']=="deleted")
                         { ?>                    <script>
                          $(function() {$("#durum4").fadeIn(500).delay(2000).fadeOut(500);});
                         </script>
                         <?php
                         }
                        ?>
        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->