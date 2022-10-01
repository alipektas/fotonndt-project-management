<?php 

include 'header.php';

$malzemesor=$db->prepare("SELECT * FROM foton_materials WHERE material_status=1");
$malzemesor->execute();
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
        <div class="col-md-1 col-sm-1 col-xs-6">
              <div id="durum1" class="alert alert-success">
					Malzeme kayıt edildi.
              </div>
              <div id="durum2" class="alert alert-danger">
					Kayıt başarısız.
              </div>
              <div id="durum3" class="alert alert-danger">
					Malzeme silindi.
              </div>
          </div>
          <div class="">


            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><b>Malzemeler</b></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <button type="button" class="btn btn-round btn-dark" data-toggle="modal" data-target=".1bs-example-modal-lg"><a  class="fa fa-plus" style="color:#ffffff;"></i></a> Malzeme Ekle</button>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <!-- sayfa içeriği başlangıç aliser -->
                  
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Tip</th>
                          <th>Marka/Model</th>
                          <th>Açıklama </th>
                          <th></th>
                        

                        </tr>
                      </thead>
                      <tbody>
                      
                      <?php 
                      
                      while($malzemecek=$malzemesor->fetch(PDO::FETCH_ASSOC))
                       
                        
                      {?>

                        <tr>
                          <td><?php echo $malzemecek['material_type']?></td>
                          <td><?php echo $malzemecek['material_brand']?></td>
                          <td><?php echo $malzemecek['material_description']?></td>
                          <td width="20" >
                          <form action="../netting/islem.php" method="POST" >
                          <input type="hidden" name="material_id" value="<?php echo $malzemecek['material_id']?>">
                          <button type="submit" name="malzemeduzenlegit" class="btn btn-primary"><i class="fa fa-pencil"></i> Düzenle </button>
                          <button type="submit" name="malzemesil" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-trash-o"></i> Sil </button>
                          </form>
                          </td>
                        </tr>
                         
                      <?php   }
                      ?>
                      </tbody>
                    </table>
                    
                    <!-- malzeme yeni kayıt -->
                    <div class="modal fade 1bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <center><h3 class="modal-title" id="myModalLabel">Yeni Malzeme Ekleme</h3></center>
                                </div>
                                <div class="modal-body">
                                <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Malzeme Tipi <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select type="text"  name="material_type"  required="required" class="form-control col-md-7 col-xs-12">

                          <option selected disabled>Seçiniz</option>
                          <option>Film</option>
                          <option>Boya/Spray</option>
                          <option>Diğer(talebe göre eklenecek)</option>
                      </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Marka/Model <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="material_brand" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Açıklama </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="material_description"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                        <input type="hidden" name="material_creator" value="<?php echo $userget['user_id']?>">
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                               <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                               <button type="submit" name="malzemekayit" class="btn btn-primary">Kaydet</button>
                      
                        </div>
                        <br />
                      </div>
                    </form></div>


                             
                                
                  </div>
                </div>
              </div>

                        <!-- sayfa içeriği son aliser-->

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
<script language="javascript">
function confirmDel() {
 var agree=confirm("Silmek istediğinizden emin misiniz?");
 if (agree) {
  return true ; }
 else {
  return false ;}
}
</script>
        <?php include 'footer.php'; ?>