<?php include 'header.php'; 

//tabloya veri çekme aliser
$deposor=$db->prepare("SELECT * FROM foton_warehouses where warehouse_status=1");
$deposor->execute();
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
					Depo kayıt edildi.
              </div>
              <div id="durum2" class="alert alert-danger">
					Kayıt başarısız.
              </div>
              <div id="durum3" class="alert alert-danger">
					Depo silindi.
              </div>
          </div>
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2><b>Depolar</b><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
    
                   <li>    
                             
                   <button type="button" class="btn btn-round btn-dark" data-toggle="modal" data-target=".1bs-example-modal-lg"><a  class="fa fa-plus" style="color:#ffffff;"></i></a> Depo Ekle</button>
                   </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                    </div>
          <div class="row">
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Adı</th>
                          <th>Tipi</th>
                          <th>Adresi</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      <?php 
                      
                      while($depocek=$deposor->fetch(PDO::FETCH_ASSOC))
                       
                        
                      {?>

                        <tr>
                          <td><?php echo $depocek['warehouse_name']?></td>
                          <td><?php echo $depocek['warehouse_type']?></td>
                          <td><?php echo $depocek['warehouse_adress']?></td>
                          <td width="20" >
                          <form action="../netting/islem.php" method="POST" >
                          <input type="hidden" name="warehouse_id" value="<?php echo $depocek['warehouse_id']?>">
                          <button type="submit" name="depoduzenlegit" class="btn btn-primary"><i class="fa fa-pencil"></i> Düzenle </button>
                          <button type="submit" name="deposil" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-trash-o"></i> Sil </button>
                          </form>
                        </tr>
                         
                      <?php   }
                      ?>
                      </tbody>
                    </table>

                                        <!-- Yeni depo kaydı aliser -->
                                        <div class="modal fade 1bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <center><h3 class="modal-title" id="myModalLabel">Yeni Depo Ekleme</h3></center>
                                </div>
                                <div class="modal-body">
                                <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Depo Adı<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="warehouse_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Depo Tipi<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <select type="text" class="select2_single form-control" name="warehouse_type" required="required" tabindex="-1">
                            <option selected disabled>Seçiniz</option>
                            <option>Sabit Depo</option>
                            <option>Araç</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="adress" name="warehouse_adress" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <input type="hidden" name="warehouse_creator" value="<?php echo $userget['user_id'] ?>">
                   
                      
 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-5 col-sm-6 col-xs-12 col-md-offset-3">
                               <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Kapat</button>
                               <button type="submit" name="depokayit" class="btn btn-round btn-dark">Kaydet</button>
                      
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
        <?php include 'footer.php'; ?>
        <!-- /footer content -->