<?php include 'header.php'; 

//tabloya veri çekme aliser
$lokasyonsor=$db->prepare("SELECT * FROM foton_locations  where location_status=1 order by location_id DESC");
$lokasyonsor->execute();
$musterisor=$db->prepare("SELECT * FROM foton_customers WHERE customer_status=1");
$musterisor->execute();
if($userget['user_aut'] != "Admin")
{
  header("location: profile.php?status=izinsizgiris");
}
else{} 
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb5WFIX6H-Ea-p6hDZItAK1mGK_6_VwDs&sensor=true"></script>
<script src="jquery-1.7.2.min.js"></script>
<script language="javascript">
function confirmDel() {
 var agree=confirm("Silmek istediğinizden emin misiniz?");
 if (agree) {
  return true ; }
 else {
  return false ;}
}
</script>
<style type="text/css">
    #durum1 {display: none;}
    #durum2 {display: none;}
    #durum3 {display: none;}
</style>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="col-md-1 col-sm-1 col-xs-6">
              <div id="durum1" class="alert alert-success">
					Lokasyon kayıt edildi.
              </div>
              <div id="durum2" class="alert alert-danger">
					Kayıt başarısız.
              </div>
              <div id="durum3" class="alert alert-danger">
					Lokasyon silindi.
              </div>
          </div>
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2><b>Lokasyonlar</b><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
    
                   <li>
                   <button type="button" class="btn btn-round btn-dark" data-toggle="modal" data-target=".1bs-example-modal-lg"><a  class="fa fa-plus" style="color:#ffffff;"></i></a> Lokasyon Ekle</button>
                   </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                    </div>
          <div class="row">
                  <div id="tablo" class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Müşteri</th>
                          <th>Lokasyon</th>
                          <th>Adres</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      <?php 
                      
                      while($lokasyoncek=$lokasyonsor->fetch(PDO::FETCH_ASSOC))
                       
                        
                      {
                        $tablomusterisor=$db->prepare("SELECT * FROM foton_customers WHERE customer_id=:customer_id and customer_status=1");
                        $tablomusterisor->execute(array(
                          'customer_id' => $lokasyoncek['location_customer']
                        ));
                        $tablomustericek=$tablomusterisor->fetch(PDO::FETCH_ASSOC)
                        ?>

                        <tr>
                          <td><?php echo $tablomustericek['customer_name']?></td>
                          <td><?php echo $lokasyoncek['location_name']?></td>
                          <td><?php echo $lokasyoncek['location_adress']?></td>
                          <td align="center" width="20">
                          <form action="../netting/islem.php" method="POST" >
                          <input type="hidden" name="location_id" value="<?php echo $lokasyoncek['location_id']?>">
                          <button type="submit" name="lokasyonduzenlegit" class="btn btn-primary"><i class="fa fa-pencil"></i> Düzenle </button>
                          <button type="submit" name="lokasyonsil" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-trash-o"></i> Sil </button>
                          </form>
                          </td>
                        </tr>
                         
                      <?php   }
                      ?>
                      </tbody>
                    </table>

                                        <!-- Yeni lokasyon kaydı aliser -->
                                        <div class="modal fade 1bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <center><h3 class="modal-title" id="myModalLabel">Yeni Lokasyon Ekleme</h3></center>
                                </div>
                                <div class="modal-body">
                                <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Müşteri/Firma Seç<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <select type="text" class="select2_single form-control" name="location_customer" required="required" tabindex="-1">
                            <option></option>
                            <?php 
                      
                      while($mustericek=$musterisor->fetch(PDO::FETCH_ASSOC))
                       
                        
                      {?>
                      <option value="<?php echo $mustericek['customer_id']?>"><?php echo $mustericek['customer_name']?></option>

                     <?php } ?>

                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Lokasyon Adı<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="location_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="adress" name="location_adress" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <input type="hidden" name="location_creator" value="<?php echo $userget['user_id'] ?>">
                   
                      
 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-5 col-sm-6 col-xs-12 col-md-offset-3">
                               <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Kapat</button>
                               <button type="submit" name="lokasyonkayit" class="btn btn-round btn-primary">Kaydet</button>
                      
                        </div>
                        <br />
                      </div>
                    </form></div>


                             
                                
                  </div>
                </div>
              </div>

                  </div>
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
        <!-- footer content -->
        <?php 
                         if ($_GET['status']=="successful") { ?>
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
                         
                         elseif($_GET['status']=="deleted")
                         { ?>                    <script>
                          $(function() {$("#durum3").fadeIn(500).delay(2000).fadeOut(500);});
                         </script>
                         <?php
                         }
                        ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- lokasyon bulma scripti başlangıç -->


    <button id="button">Konumumu Bul</button>
<div id="result"></div>



        <?php include 'footer.php'; ?>