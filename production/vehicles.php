<?php include 'header.php'; 

//tabloya veri çekme aliser
$aracsor=$db->prepare("SELECT * FROM foton_vehicles WHERE vehicle_status=1");
$aracsor->execute();
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
</style>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="col-md-1 col-sm-1 col-xs-6">
              <div id="durum1" class="alert alert-success">
					Araç kayıt edildi.
              </div>
              <div id="durum2" class="alert alert-danger">
					Kayıt başarısız.
              </div>
              <div id="durum3" class="alert alert-danger">
					Araç silindi.
              </div>
          </div>
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2><b>Araçlar</b><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
    
                    <button type="button" class="btn btn-round btn-dark" data-toggle="modal" data-target=".1bs-example-modal-lg"><a  class="fa fa-plus" style="color:#ffffff;"></i></a> Araç Ekle</button>
                     
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
            </div>
          <div class="row">
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Plaka</th>
                          <th>Model</th>
                          <th></th>
                        

                        </tr>
                      </thead>
                      <tbody>
                      
                      <?php 
                      
                      while($araccek=$aracsor->fetch(PDO::FETCH_ASSOC))
                       
                        
                      {?>

                        <tr>
                          <td><?php echo $araccek['vehicle_plaka']?></td>
                          <td><?php echo $araccek['vehicle_model']?></td>
                          <td width="20" >
                          <form action="../netting/islem.php" method="POST" >
                          <input type="hidden" name="vehicle_id" value="<?php echo $araccek['vehicle_id']?>">
                          <button type="submit" name="aracduzenlegit" class="btn btn-primary"><i class="fa fa-pencil"></i> Düzenle </button>
                          <button type="submit" name="aracsil" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-trash-o"></i> Sil </button>
                          </form>
                          </td>
                        </tr>
                         
                      <?php   }
                      ?>
                      </tbody>
                    </table>
                    
                    <!-- araç yeni kayıt -->
                    <div class="modal fade 1bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <center><h3 class="modal-title" id="myModalLabel">Yeni Araç Ekleme</h3></center>
                                </div>
                                <div class="modal-body">
                                <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Plaka <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="vehicle_plaka"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <br />
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Model <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="vehicle_model" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <input type="hidden" name="vehicle_creator" value="<?php echo $userget['user_id']?>">

                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                               <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                               <button type="submit" name="arackayit" class="btn btn-primary">Kaydet</button>
                      
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
        <script language="javascript">
function confirmDel() {
 var agree=confirm("Silmek istediğinizden emin misiniz?");
 if (agree) {
  return true ; }
 else {
  return false ;}
}
</script>
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