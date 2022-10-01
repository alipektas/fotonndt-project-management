<?php include 'header.php'; 

/* 
    status == 0 > silindi
    status == 1 > aktif/iş emri durumunda
    status == 2 > Saha görevinde
    status == 3 > Tamamlanmış/sonlandırılmış saha görevi

*/

//tabloya veri çekme aliser

$cihazsor=$db->prepare("SELECT * FROM foton_equipment WHERE equipment_status=1");
$cihazsor->execute();
$isemrisor=$db->prepare("SELECT * FROM foton_fieldtasks WHERE fieldtask_status=1");
$isemrisor->execute();
$lokasyonsor=$db->prepare("SELECT * FROM foton_locations  where location_status=1");
$lokasyonsor->execute();

?>
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
					Görev planı kayıt edildi.
              </div>
              <div id="durum2" class="alert alert-danger">
					İşlem başarısız.
              </div>
              <div id="durum3" class="alert alert-danger">
					Görev planı silindi.
              </div>
          </div>
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2><b>Planlanan Görevler</b><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
              <a href="fieldtask-new.php" <button class="btn btn-round btn-dark"><div  class="fa fa-plus" style="color:#ffffff;"></i></div> Yeni Görev Planı</button></a>
                     
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
            </div>
          <div class="row">
                  <div class="x_content">

                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>İş Emri No</th>
                          <th>Müşteri</th>
                          <th>Saha Sorumlusu</th>
                          <th>Oluşturulma Tarihi</th>
                          <th>Planlanan Tarih</th>
                          
                          <th></th>
                        

                        </tr>
                      </thead>
                      <tbody>
                      
                      <?php 
                      
                      while($isemricek=$isemrisor->fetch(PDO::FETCH_ASSOC))


                      { 
                        $sahamusterisor=$db->prepare("SELECT * FROM foton_customers where customer_id=:customer_id");
$sahamusterisor->execute(array('customer_id' => $isemricek['fieldtask_customer']));
$sahamustericek=$sahamusterisor->fetch(PDO::FETCH_ASSOC);
                        $kullanicisor=$db->prepare("SELECT * FROM foton_users WHERE user_id=:user_id");
                        $kullanicisor->execute(array('user_id' => $isemricek['fieldtask_personal_res']));
                        $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);?>

                        <tr>
                          <td><?php echo $isemricek['fieldtask_id']?></td>
                          <td><?php echo $sahamustericek['customer_name']?></td>
                          <td><?php echo $kullanicicek['user_name']?> <?php echo $kullanicicek['user_surname']?></td>
                          <td><?php echo $isemricek['fieldtask_date_created']?></td>
                          <td><?php echo $isemricek['fieldtask_date_planned']?></td>
                          <td align="center" width="20" >
                          <form action="../netting/islem.php" method="POST" >
                          <input type="hidden" name="fieldtask_id" value="<?php echo $isemricek['fieldtask_id']?>">
                          <button type="submit" name="sahaplanbaslat" class="btn btn-success"><i class="fa fa-rocket"></i> Görevi Başlat </button>
                          <button type="submit" name="sahaplanduzenle" class="btn btn-primary"><i class="fa fa-pencil"></i> Düzenle </button>
                          <button type="submit" name="sahaplansil" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-trash-o"></i> Sil </button>
                          </form>
                          </td>

                        </tr>
                         
                      <?php   }
                      ?>
                      </tbody>
                    </table>
                    
                    <!-- görev yeni kayıt -->

            </div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>
        <!-- /page content -->
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
        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->

