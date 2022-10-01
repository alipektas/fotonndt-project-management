<?php include 'header.php'; 

//tabloya veri çekme aliser
$cihazsor=$db->prepare("SELECT * FROM foton_equipment WHERE equipment_status=1");
$cihazsor->execute();
$isemrisor=$db->prepare("SELECT * FROM foton_fieldtasks WHERE fieldtask_id=:fieldtask_id");
$isemrisor->execute(array('fieldtask_id' => $_GET['fieldtask_id']));
$isemricek=$isemrisor->fetch(PDO::FETCH_ASSOC);
$malzemesor=$db->prepare("SELECT * FROM foton_materials WHERE material_status=1");
$malzemesor->execute();
$modalmalzemesor=$db->prepare("SELECT * FROM foton_materials WHERE material_status=1");
$modalmalzemesor->execute();

$a=$isemricek['fieldtask_status'];

if($a== 1 || $a == 2)
{
  header("location: fieldtasks.php?status=tamamlanmayangorev");
}
else{} 

$musterisor=$db->prepare("SELECT * FROM foton_customers  where customer_id=:fieldtask_customer");
$musterisor->execute(array('fieldtask_customer' => $isemricek['fieldtask_customer']));
$mustericek=$musterisor->fetch(PDO::FETCH_ASSOC);
$muteahhitsor=$db->prepare("SELECT * FROM foton_customers  where customer_id=:fieldtask_subcontractor");
$muteahhitsor->execute(array('fieldtask_subcontractor' => $isemricek['fieldtask_subcontractor']));
$muteahhitcek=$muteahhitsor->fetch(PDO::FETCH_ASSOC);
$kullanicisor=$db->prepare("SELECT * FROM foton_users  where user_status=1");
$kullanicisor->execute();
$lokasyonsor=$db->prepare("SELECT * FROM foton_locations  where location_status=1");
$lokasyonsor->execute();
$projesor=$db->prepare("SELECT * FROM foton_projects  where project_status=1");
$projesor->execute();
$aracsor=$db->prepare("SELECT * FROM foton_vehicles  where vehicle_status=1");
$aracsor->execute();
$sahasorumlusor=$db->prepare("SELECT * FROM foton_users  where user_id=:user_id");
$sahasorumlusor->execute(array('user_id' => $isemricek['fieldtask_personal_res']));
$sahasorumlucek=$sahasorumlusor->fetch(PDO::FETCH_ASSOC);
$projesor=$db->prepare("SELECT * FROM foton_projects  where project_id=:project_id");
$projesor->execute(array('project_id' => $isemricek['fieldtask_projectno']));
$projecek=$projesor->fetch(PDO::FETCH_ASSOC);
$ekipmansor=$db->prepare("SELECT * FROM foton_equipment  where equipment_id=:equipment_id");
$ekipmansor->execute(array('equipment_id' => $isemricek['fieldtask_equipment']));
$ekipmancek=$ekipmansor->fetch(PDO::FETCH_ASSOC);
?>
  <style type="text/css">
    .select2 {width:100%!important;}
    #durum1 {display: none;}
		#kaynak-detay {display: none;}
    #kaynak-guncelleme-alani {display: none;}
    #malzeme-to-kaynak-ekle {display: none;}
    #malzeme-guncelleme {display: none;}
    #geridon {display: none;}
    #kayit-ekle {display: none;}
    #malzeme-ekleme-alani {display: none;}
		#bos-alan {display: none;}
    #malzeme-duz {display: none;}
    #malzeme-listele {display: none;}
    #bos-alan-konum {display: none;}
		#basari-islem {display: none;}
		#basari-islem-duzenle {display: none;}
	</style>
		<script type="text/javascript" src="js/fieldtask-archive.js"></script>
<input type="hidden" class="getting" name="getting" value="<?php echo $isemricek['fieldtask_id']?>">
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="col-md-1 col-sm-1 col-xs-6">
              <div id="durum1" class="alert alert-warning">
					Başarısız.
              </div>
          </div>
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="row">
                  <div class="x_content">
                  <div class="x_title">
  <h2>İş Emri No: <?php echo $isemricek['fieldtask_id']?></h2> <div style="float:right;" > <a href="fieldtasks-archive.php"><button type="button" class="btn btn-warning" data-dismiss="modal">Arşive dön</button> </div>
  <div class="clearfix"></div>
</div>
                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Görev Detayları</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                          <section class="panel">
<div class="panel-body">
  <div class="project_detail">
  <div class="col-md-2 col-sm-2 col-xs-4 form-group">
    <p class="title">Müşteri</p>
      <p><?php echo $mustericek['customer_name']?></p>
    <p class="title">Müteahhit</p>
      <p><?php echo $muteahhitcek['customer_name']?></p>
    <p class="title">Proje No</p>
      <p><?php echo $projecek['project_no']?></p>
    <p class="title">Saha Sorumlusu</p>
      <p><?php echo $sahasorumlucek['user_name']?> <?php echo $sahasorumlucek['user_surname']?></p>
  </div>
  <div class="col-md-2 col-sm-2 col-xs-4 form-group">
  <p class="title">Ekipman (Seri no & Model)</p>
    <p><?php echo $ekipmancek['equipment_serial']?> - <?php echo $ekipmancek['equipment_model']?></p>
  <p class="title">Kaynak Metodu</p>
    <p><?php echo $isemricek['fieldtask_welding_method']?></p>
  <p class="title">Kaynak Geometrisi</p>
    <p><?php $a = $isemricek['fieldtask_welding_geometry'] ;
    echo implode($a)?></p>
      <p class="title">İş Emri Oluşturulma Tarihi</p>
    <p><?php echo $isemricek['fieldtask_date_created']?></p>
    <p class="title">İş Emri Başlama Tarihi</p>
    <p><?php echo $isemricek['fieldtask_date_start']?></p>
    <p class="title">İş Emri Bitme Tarihi</p>
    <p><?php echo $isemricek['fieldtask_date_finish']?></p>
</div>
  </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                          <h4 class="panel-title">Kaynaklar & Malzemeler</h4><div id="basari-islem" class="alert alert-success"></div>			<div id="basari-islem-duzenle" class="alert alert-success"></div>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
        <button type="button" id="geridon" class="btn btn-warning">İş Emrine Geri Dön</button>
                          <div class="container">
			<div>	

      </div>


      <div id="malzeme-ekleme-alani">
      <div id="kaynak-detay">
        </br>
        <label> Kaynak No:  </label><label id="kaynak-no"> - </label></br>
        <label>   Test Metodu:  </label><label id="kaynak-testmetodu"> - </label></br>
        <label>   Çap:  </label><label id="kaynak-cap"> - </label></br>
        <label>   Metraj:  </label><label id="kaynak-metraj"> - </label></br>
        <label>   Kaynakçı:  </label><label id="kaynak-kaynakci"> - </label></br>
      </div>
</div>
<div id="malzeme-listele"></div>
		</div><div id="listele"></div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <!-- end of accordion -->
            </div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>
        <!-- /page content -->
        <?php 
                         if($_GET['status']=="unsuccessful")
                         {?>                    <script>
                          $(function() {$("#durum1").fadeIn(500).delay(2000).fadeOut(500);});
                         </script>
                         <?php
                         } 
                         
                        ?>
        <!-- footer content -->
            <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Seçiniz",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->
        <?php include 'footer.php'; ?>

