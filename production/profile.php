<?php include 'header.php'; 

//tabloya veri çekme aliser
$isemriplansor=$db->prepare("SELECT * FROM foton_fieldtasks WHERE fieldtask_status=1 and fieldtask_personal_res=:fieldtask_personal_res order by fieldtask_id");
$isemriplansor->execute(array(  'fieldtask_personal_res' => $userget['user_id']));
$isemriaktifsor=$db->prepare("SELECT * FROM foton_fieldtasks WHERE fieldtask_status=2 and fieldtask_personal_res=:fieldtask_personal_res order by fieldtask_id");
$isemriaktifsor->execute(array(  'fieldtask_personal_res' => $userget['user_id']));

?>
<style>
  #map {
    height: 100%;
  }
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>
        <!-- page content -->
<div class="right_col" role="main">
          <!-- top tiles -->
          <input type="hidden" class="getting" name="getting" value="<?php echo $userget['user_id']?>">
  <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
                    <h2><b>Profil:</b> <?php echo $userget['user_name'] ; echo (" "); echo $userget['user_surname']?><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
    
                    <button type="button" class="btn btn-round btn-dark" data-toggle="modal" data-target=".1bs-example-modal-sm"><a  class="fa fa-plus" style="color:#ffffff;"></i></a> Firma Ekle</button>
                     
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
 <div id="map"></div>
          <div class="row">
                  <div class="x_content">
            <div id="front">
              <button onclick="" id="shift_pre" type="button" class="btn btn-round btn-dark">Mesai Başlat</button>
              <div class="clearfix"></div>
              <button onclick="" id="shift_active" type="button" class="btn btn-round btn-dark">Aktif Mesailer</button>
              <div class="clearfix"></div>
              <button onclick="" id="shift_archive" type="button" class="btn btn-round btn-dark">Mesai Arşivim</button>
              <div class="clearfix"></div>
            </div>
            <div id="shift-sort-active"></div>  <!-- Kişinin aktif mesaileri divi -->   
         
         <!-- MÜŞTERİ EKLEME MODAL BAŞLANGIÇ -->
            <div class="modal fade 1bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">

                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <center><h3 class="modal-title" id="myModalLabel">Firma Ekleme</h3></center>
                                </div>
                                <div class="modal-body">
                                <form  method="POST" id="customer-add" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Firma: <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                          <input type="text" name="customer_name"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                    <input type="hidden" name="customer_creator" value="<?php echo $userget['user_id']?>">
                    
                               <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                               <button type="submit" name="musterikayit" class="btn btn-primary">Kaydet</button>  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div  class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
           
                        </div>
                        <br />
                      </div>
                    </form>
                                </div>
            
                  </div>
          </div>
         </div>
         <!-- MÜŞTERİ EKLEME MODAL BİTİŞ -->


            </div>
          </div>
          </div>
        </div>
        </div>
  </div>
</div>
        <!-- /page content -->


        
        <!-- footer content -->
        <?php include 'footer.php'; ?>
