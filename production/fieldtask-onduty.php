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

if($a== 1 || $a == 3)
{
  header("location: fieldtasks.php?status=aktifolmayangorev");
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
		<script type="text/javascript" src="js/ozel.js"></script>
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
  <h2>İş Emri No: <?php echo $isemricek['fieldtask_id']?></h2>
  <div class="clearfix"></div>
</div>
                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          <h4 class="panel-title">Görev Detayları</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
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
    <p class="title">Kaynak Geometrisi</p>
    <p><?php echo $isemricek['fieldtask_personal_team']?></p>
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
				<button type="button" id="yeni-ekle" class="btn btn-success">Kaynak No Ekle</button>
                          <div class="container">
			<div>			<div id="bos-alan" class="alert alert-danger">
					Form Alanlarını Boş Bırakamazsınız
				</div>

			

			<div id="kayit-ekle">
        <div style="width: 100%" class="col-md-3 col-sm-3 col-xs-5">      
        <form  method="post" id="kaynakno-ekle" >
                </br>
                </br><label>Test Metodu</label></br>
              <select class="select2_single form-control" type="text" id="fieldtask_welding_method" name="fieldtask_welding_method"  required="required" class="form-control" >
                <option>RT</option>
                <option>PT</option>
                <option>MT</option>
                <option>UT</option>
              </select></br>
              </br><label>Kaynak No</label></br>
              <input type="text" id="fieldtask_welding_no" name="fieldtask_welding_no" class="form-control "   required="required" >
              </br><label>Çap</label></br>
              <select class="select2_single form-control" type="text" id="fieldtask_welding_size" name="fieldtask_welding_size"  required="required" class="form-control" >
              <option></option>
                <option>Metraj</option>
                <option>1"</option>
                <option>1 1/4"</option>
                <option>1 1/2"</option>
                <option>2"</option>
                <option>2 1/2"</option>
                <option>3"</option>
                <option>4"</option>
                <option>5"</option>
                <option>6"</option>
                <option>8"</option>
                <option>10"</option>
                <option>12"</option>
                <option>14"</option>
                <option>16"</option>
                <option>18"</option>
                <option>20"</option>
                <option>22"</option>
                <option>24"</option>
                <option>26"</option>
                <option>28"</option>
                <option>30"</option>
                <option>32"</option>
                <option>34"</option>
                <option>36"</option>
                <option>38"</option>
                <option>40"</option>
                <option>42"</option>
                <option>48"</option>
                <option>56"</option>
                <option>60"</option>
              </select></br>
              </br><label>Metraj (mm)</label></br>
              <input type="number" id="fieldtask_welding_length" name="fieldtask_welding_length" placeholder="Sadece çap alanı metraj seçildiğinde giriniz." class="form-control" >
              </br><label>Kaynakçı</label></br>
              <input type="text" id="fieldtask_welding_welderno" name="fieldtask_welding_welderno" class="form-control" >   
              </br>       
              <input type="hidden" name="fieldtask_welding_isno" value="<?php echo $isemricek['fieldtask_id']?>">
              <input type="hidden" name="fieldtask_welding_creator" value="<?php echo $userget['user_id']?>">                                             
              <button type="button" id="kaynak-gonder" class="btn btn-primary">Kaydet</button>
             </div>    
        </form>
		
				</div>
<button type="button" id="malzeme-to-kaynak-ekle" class="btn btn-warning">Yeni Kaynak</button>
      </div>

      <div id="kaynak-guncelleme-alani" style="width: 100%" class="col-md-2 col-sm-2 col-xs-4 form-group">
          <form action="" method="POST" id="kaynak-guncelleme-formu">
          </br>
          </br><label>Test Metodu</label></br>
              <select class="select2_single form-control" style="width: 300px; height: 200px" type="text" id="fieldtask_welding_method_gun" name="fieldtask_welding_method"  required="required" class="form-control" >
                <option>RT</option>
                <option>PT</option>
                <option>MT</option>
                <option>UT</option>
              </select></br>
              </br><label>Kaynak No</label></br>
              <input type="text" id="fieldtask_welding_no_gun" name="fieldtask_welding_no" class="form-control"   required="required" >

              </br><label>Çap</label></br>
              <select class="select2_single form-control" type="text" id="fieldtask_welding_size_gun" name="fieldtask_welding_size"  required="required" class="form-control" >
              <option></option>
                <option>Metraj</option>
                <option>1"</option>
                <option>1 1/4"</option>
                <option>1 1/2"</option>
                <option>2"</option>
                <option>2 1/2"</option>
                <option>3"</option>
                <option>4"</option>
                <option>5"</option>
                <option>6"</option>
                <option>8"</option>
                <option>10"</option>
                <option>12"</option>
                <option>14"</option>
                <option>16"</option>
                <option>18"</option>
                <option>20"</option>
                <option>22"</option>
                <option>24"</option>
                <option>26"</option>
                <option>28"</option>
                <option>30"</option>
                <option>32"</option>
                <option>34"</option>
                <option>36"</option>
                <option>38"</option>
                <option>40"</option>
                <option>42"</option>
                <option>48"</option>
                <option>56"</option>
                <option>60"</option>
              </select></br>
              </br><label>Metraj (mm)</label></br>
              <input type="text" id="fieldtask_welding_length_gun" name="fieldtask_welding_length" class="form-control" >
              </br><label>Kaynakçı</label></br>
              <input type="text" id="fieldtask_welding_welderno_gun" name="fieldtask_welding_welderno" class="form-control" >
              <input type="hidden" id="fieldtask_welding_id_gun" name="fieldtask_welding_id" class="form-control" >   
              </br>       
              <button type="button" id="kaynak-guncelleme-butonu" class="btn btn-primary">Güncelle</button>
              <button type="button" id="kaynak-guncelleme-vazgec" class="btn btn-default">Vazgeç</button>
          </form>
      </div>  

      <div id="malzeme-ekleme-alani">
      <div id="kaynak-detay">
        </br>
        <label> Kaynak No:  </label><label id="kaynak-no"> - </label></br>
        <label>   Test Metodu:  </label><label id="kaynak-testmetodu"> - </label></br>
        <label>   Çap:  </label><label id="kaynak-cap"> - </label></br>
        <label>   Metraj:  </label><label id="kaynak-metraj"> - </label></br>
        <label>   Kaynakçı:  </label><label id="kaynak-kaynakci"> - </label></br>
        <button type="button" value="" id="kaynak-guncelleme-alani-acma" class="btn btn-success">Kaynak Bilgilerini Değiştir</button>
      </div>


<!-- eklenen kaynak numarasına malzeme ekleme formu başlangıç-->
    <form  method="post" id="malzeme-ekle" >
<div class="col-md-5 col-sm-5 col-xs-6 form-group">
<label>Film</label>
  <select class="select2_single form-control" type="text" id="welding_material_sid" name="welding_material_sid"  required="required" class="form-control" >
    <option></option>
    <?php
    while($malzemecek=$malzemesor->fetch(PDO::FETCH_ASSOC))
    {?>
    <option value="<?php echo $malzemecek['material_id']?>"><?php echo $malzemecek['material_brand']?> <?php echo $malzemecek['material_dimension']?></option>
    <?php } ?>
  </select>
</div>

<div class="col-md-4 col-sm-4 col-xs-6 form-group">
            <label>Adet </label>
              <input type="number" id="welding_material_quantity" name="welding_material_quantity" class="form-control" >
            </div>

  <input type="hidden" id="weldingno" name="welding_material_wno" value="">
  <input type="hidden" name="welding_material_creator" value="<?php echo $userget['user_id']?>">

                      <div class="col-md-2 col-sm-2 col-xs-3"></div>

<div class="form-group">                        
                      <div class="col-md-6 col-sm-6 col-xs-12">
  <button type="button" id="malzeme-gonder" class="btn btn-primary">Film Ekle</button>


                      </div>
</div>

</form>
<!-- eklenen kaynak numarasına malzeme ekleme formu bitiş-->
</div>

<div id="malzeme-guncelleme">
<form  method="post" id="malzeme-guncelleme-formu" >
<div class="col-md-5 col-sm-5 col-xs-6 form-group">
<label>Film</label>
  <select class="select2_single form-control" type="text" id="welding_material_sid-guncel" name="welding_material_sid" required="required" class="form-control" >
    <option></option>
    <?php
    while($modalmalzemecek=$modalmalzemesor->fetch(PDO::FETCH_ASSOC))
    {?>
    <option value="<?php echo $modalmalzemecek['material_id']?>"><?php echo $modalmalzemecek['material_brand']?> <?php echo $modalmalzemecek['material_dimension']?></option>
    <?php } ?>
  </select>
  <label>Adet</label>
  <input type="number" id="welding_material_quantity-guncel" name="welding_material_quantity" class="form-control">
  <input type="hidden" id="welding_material_id-guncel" name="welding_material_id" value="">
  <button type="button" id="malzeme-guncelleme-butonu" class="btn btn-primary">Malzeme Güncelle</button>
  <button type="button" id="malzeme-guncelleme-vazgec" class="btn btn-default">Vazgeç</button>
</div>
</form>
</div>

<div id="malzeme-listele"></div>
			<div id="malzeme-duz">
				<h3>Düzenleme / Film Ekleme</h3>
				<hr>
				<form method="post" id="malzeme-guncelle">
        <div class="form-group">
<div class="form-group">
					<button type="button" id="mlz-guncelle" class="btn btn-primary">Güncelle</button>
					<button type="button" id="geridonduzenle" class="btn btn-warning">Geri Dön</button>
</div>        
					<div class="col-md-2 col-sm-2 col-xs-4 form-group">
          <h4 class="panel-title">Kaynak Bilgileri</h4>
						<label>Kaynak No</label>
						<input type="text" class="form-control" id="welding_material_sid2" name="welding_material_sid" value="">
            <label>Çap</label>
						<input type="text" readonly class="form-control" id="fieldtask_material_size2" name="fieldtask_material_size" value="">
            <label>Kalınlık</label>
						<input type="text" readonly class="form-control" id="fieldtask_material_thickness2" name="fieldtask_material_thickness" value="">
            <label>Kaynakçı</label>
						<input type="text" readonly class="form-control" id="fieldtask_material_welderno2" name="fieldtask_material_welderno" value="">
            <label>İmaj</label>
						<input type="text" readonly class="form-control" id="fieldtask_material_image2" name="fieldtask_material_image" value="">
					</div>
          <div class="col-md-1 col-sm-1 col-xs-1 form-group"></div>
            <div class="col-md-2 col-sm-2 col-xs-3 form-group">
            <h4 class="panel-title">Malzemeler</h4>
            <label>10x12</label>
            <input type="number" class="form-control" id="film_10x12" name="film_10x12" value="">
            <label>10x16</label>
            <input type="number" class="form-control" id="film_10x16" name="film_10x16" value="">
            <label>10x24</label>
            <input type="number" class="form-control" id="film_10x24" name="film_10x24" value="">
            <label>10x36</label>
						<input type="number" class="form-control" id="film_10x36" name="film_10x36" value="">
						<label>10x48</label>
            <input type="number" class="form-control" id="film_10x48" name="film_10x48" value="">
					  </div>
					<input type="hidden" name="malzemeekle">
					<input type="hidden" id="fieldtask_material_id" name="fieldtask_material_id" value="">
        </div>
				</form>
			</div>
		</div><div id="listele"></div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Saha Görevini Bitirme</h4>
                        </a>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <p><strong></strong>
                            </p>

                  <!-- Small modal konum alma-->
                  <button type="button"  class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Görevi Sonlandır</button>

                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Bilgilendirme & Uyarı</h4>
                        </div>
                        <div class="modal-body">
                          <p>Lütfen "Görev Sonlandırma" işlemini sahada ve açık alanda konumunuzu doğrulayarak gerçekleştiriniz.</p>
                          <p>Konumunuzu alabilmemiz için tarayıcınıza gerekli izni vermeniz gerekmektedir. Yüksek hassasiyet/doğrulukta konum kaydetmek için kullandığınız mobil cihazın "Lokasyon" servisinin açık ve "Yüksek doğruluk" modunda olması gerekmektedir.</p>
                          <p><b>Sonlandırma işlemini geri alamazsınız.</b> Lütfen saha görevinizi tam ve eksiksiz bitirdiğinizden emin olmadan sonlandırma işlemini onaylamayınız.</p>
                      <form  action="../netting/islem.php" method="POST">
                      <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görev Bitiş Konumu</span></label>
                        </div>   
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="latitude" name="fieldtask_personal_egeolocation_latitude" value="" required="required" readonly="readonly" placeholder="Enlem" class="form-control col-md-7 col-xs-12">
                      </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="longitude" name="fieldtask_personal_egeolocation_longitude" value="" required="required" readonly="readonly" placeholder="Boylam" class="form-control col-md-7 col-xs-12">
                      </div>
                        </div>                          
                      <div class="col-md-3 col-sm-3 col-xs-12  input-group">

                             <input type="hidden" name="fieldtask_id" value="<?php echo $isemricek['fieldtask_id']?>">
                            <span class="input-group-btn">
                                              <button type="button" id="konum-bul" class="btn btn-primary">Konumu Bul</button>
                                              <button type="button" id="konum-sil" class="btn btn-default">Sıfırla</button>
                                          </span>
                          </div>
                                            
                        </div>                            <div id="bos-alan-konum" class="alert alert-danger">
					Konum almadan görevi sonlandıramazsınız!
                      </div>
                        <div class="modal-footer">
                          <button type="button"  class="btn btn-default lokasyonvazgec" data-dismiss="modal">Vazgeç</button>
                          <button type="submit" id="gorev-bitirme" name="sahabitirme" class="btn btn-primary">Onayla ve Sonlandır</button>
                        </div>
</form>
                      </div>
                    </div>
                  </div>
                  <!-- /modals konum alma sonu-->
    





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

