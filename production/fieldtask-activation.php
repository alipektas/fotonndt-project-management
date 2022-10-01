<?php include 'header.php'; 

//tabloya veri çekme aliser
$cihazsor=$db->prepare("SELECT * FROM foton_equipment WHERE equipment_status=1");
$cihazsor->execute();
$isemrisor=$db->prepare("SELECT * FROM foton_workorder WHERE workorder_status=1");
$isemrisor->execute();
$musterisor=$db->prepare("SELECT * FROM foton_customers  where customer_status=1");
$musterisor->execute();
$kullanicisor=$db->prepare("SELECT * FROM foton_users  where user_status=1");
$kullanicisor->execute();
$lokasyonsor=$db->prepare("SELECT * FROM foton_locations  where location_status=1");
$lokasyonsor->execute();
$projesor=$db->prepare("SELECT * FROM foton_projects  where project_status=1");
$projesor->execute();
$aracsor=$db->prepare("SELECT * FROM foton_vehicles  where vehicle_status=1");
$aracsor->execute();
$malzemesor=$db->prepare("SELECT * FROM foton_materials  where material_status=1");
$malzemesor->execute();

//veri çekme işlemleri
$ayarsor=$db->prepare("SELECT * FROM foton_fieldtasks where fieldtask_id=:id");
$ayarsor->execute(array('id' => $_GET['id']));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
$sahasorumlusor=$db->prepare("SELECT * FROM foton_users  where user_id=:user_id");
$sahasorumlusor->execute(array('user_id' => $ayarcek['fieldtask_personal_res']));
$sahasorumlucek=$sahasorumlusor->fetch(PDO::FETCH_ASSOC);
$sahamusterisor=$db->prepare("SELECT * FROM foton_customers where customer_id=:customer_id");
$sahamusterisor->execute(array('customer_id' => $ayarcek['fieldtask_customer']));
$sahamustericek=$sahamusterisor->fetch(PDO::FETCH_ASSOC);
$sahamuteahhitsor=$db->prepare("SELECT * FROM foton_customers where customer_id=:customer_id");
$sahamuteahhitsor->execute(array('customer_id' => $ayarcek['fieldtask_subcontractor']));
$sahamuteahhitcek=$sahamuteahhitsor->fetch(PDO::FETCH_ASSOC);
$sahalokasyonsor=$db->prepare("SELECT * FROM foton_locations  where location_id=:location_id");
$sahalokasyonsor->execute(array('location_id' => $ayarcek['fieldtask_subcontractor_location']));
$sahalokasyoncek=$sahalokasyonsor->fetch(PDO::FETCH_ASSOC);
$a=$ayarcek['fieldtask_personal_res'];
/*
if($a== $userget['user_id'])
{
  
}
else{
  header("location: fieldtasks.php?status=yetkiyok");
}*/

?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb5WFIX6H-Ea-p6hDZItAK1mGK_6_VwDs&sensor=true"></script>
<style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        
        #map {
          position: fixed;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    z-index: 100;
        }
        /* Optional: Makes the sample page fill the window. */
        
 
    </style>
<style type="text/css">
		

    #bos-alan {

display: none;
}
</style>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2><b>Görev Başlatma</b><small></small></h2>
                    <div class="clearfix"></div>
            </div>
          <div class="row">
       
                  <div class="x_content">
                  <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İş Emri No</span>
  </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="text" value="<?php echo $ayarcek['fieldtask_id']?>" name="fieldtask_id" readonly="readonly" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Müşteri</span>
  </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="text" value="<?php echo $sahamustericek['customer_name']?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Müteahhit</span>
  </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="text" value="<?php echo $sahamuteahhitcek['customer_name']?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Lokasyon</span>
  </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="text" value="<?php echo $sahalokasyoncek['location_name']?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Saha Sorumlusu</span>
  </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="text" value="<?php echo $sahasorumlucek['user_name']?> <?php echo $sahasorumlucek['user_surname']?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Cihaz (Seri No)<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select type="text" class="select2_single form-control" name="fieldtask_equipment" required="required">
      <option></option>
      <?php 

while($cihazcek=$cihazsor->fetch(PDO::FETCH_ASSOC))
 
  
{?>
<option value="<?php echo $cihazcek['equipment_id']?>"><?php echo $cihazcek['equipment_serial']?></option>

<?php } ?>

    </select>
  </div>
</div>
<!--
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cihaz Enerji Seviyesi <span class="required">*</span>
  </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="number" step="any" name="fieldtask_equipment_energylevel"  required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Active Core Size </label>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="number" step="any" name="fieldtask_activecoresize" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Kaynak Yöntemi<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select type="text" class="select2_single form-control" name="fieldtask_welding_method" required="required">
      <option>V</option>
    </select>
  </div>
</div> -->
<!-- /page content 
<label>Hobbies (2 minimum):</label>
                      <p style="padding: 5px;">
                        <input type="checkbox" name="fieldtask_welding_geometry[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat" /> Skiing
                        <br />

                        <input type="checkbox" name="fieldtask_welding_geometry[]" id="hobby2" value="run" class="flat" /> Running
                        <br />

                        <input type="checkbox" name="fieldtask_welding_geometry[]" id="hobby3" value="eat" class="flat" /> Eating
                        <br />

                        <input type="checkbox" name="fieldtask_welding_geometry[]" id="hobby4" value="sleep" class="flat" /> Sleeping
                        <br />
                        <p>
-->
<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kaynak Geometrisi<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select type="text" name="fieldtask_welding_geometry[]" class="select2_multiple form-control" required="required" multiple="multiple">
                            <option></option>
                            <option>GTAW+SMAW</option>
                            <option>SMAW+GTAW</option>
                            <option>GTAW</option>
                            <option>SMAW</option>
                            <option>SAW</option>
                            <option>TIG</option>
                          </select>
                        </div>
                      </div>


<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Araç (Plaka)<span class="required">*</span></label>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <select type="text" class="select2_single form-control" name="fieldtask_vehicle" required="required">
      <option></option>
      <?php 

while($araccek=$aracsor->fetch(PDO::FETCH_ASSOC))
 
  
{?>
<option value="<?php echo $araccek['vehicle_id']?>"><?php echo $araccek['vehicle_model']?> <?php echo $araccek['vehicle_plaka']?></option>

<?php } ?>

    </select>
  </div>
</div>

<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ekip Oluştur</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select name="fieldtask_personal_team[]" class="select2_multiple2 form-control" multiple="multiple">
                            <option</option>
                          <?php 

        while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC))
 
  
                    {?>
                            <option value="<?php echo $kullanicicek['user_name']?> <?php echo $kullanicicek['user_surname']?>"><?php echo $kullanicicek['user_name']?> <?php echo $kullanicicek['user_surname']?></option>


                            <?php } ?>

                          </select>
                        </div>
                      </div>
                      <div id="bos-alan" class="alert alert-danger">
					Konum almadan görevi başlatamazsınız!
                      </div>
                      <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görev Başlangıç Konumu</span></label>
                        <div class="col-md-4 col-sm-6 col-xs-12">

                      </div>
                        </div>   
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="latitude" name="fieldtask_personal_bgeolocation_latitude" value="" required="required" readonly="readonly" placeholder="Enlem" class="form-control col-md-7 col-xs-12">
                      </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="longitude" name="fieldtask_personal_bgeolocation_longitude" value="" required="required" readonly="readonly" placeholder="Boylam" class="form-control col-md-7 col-xs-12">
                      </div>
                        </div>                          
                      <div class="col-md-3 col-sm-3 col-xs-12  input-group">

                             
                            <span class="input-group-btn">
                                              <button type="button" id="konum-bul" class="btn btn-primary">Konumu Bul</button>
                                              <button type="button" id="konum-sil" class="btn btn-default">Sıfırla</button>
                                          </span>
                                          
                                        
                          </div>

<div type="map" id="map" class="x_title"></div>

                      <input type="hidden" name="fieldtask_lastupdater" value="<?php echo $userget['user_id']?>">
                      <div class="ln_solid"></div>
                      <div class="form-group">
  <div align="right" class="col-md-6 col-sm-6 col-xs-12 ">
        <a href="fieldtasks.php"><button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
        
         <button type="submit" id="aktif-etme" name="sahaaktif" class="btn btn-primary">Görevi Aktif Et</button>

  </div>
  <br />
</div>
</form>

            </div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->

        <!-- /footer content -->

        <!-- lokasyon bulma scripti başlangıç -->

<script>
    $("#aktif-etme").click(function() {


if (
    $("#latitude").val() == "" ||
    $("#longitude").val() == ""
  ) {


    $("#bos-alan").fadeIn(500).delay(2000).fadeOut(500);

    event.preventDefault();

} else {}

});

$("#konum-sil").click(function(){
  $("#latitude").val("");
  $("#longitude").val("");
}

);
</script> 

   


 
<script>
   

      


    // butonu seçelim
    let button = document.getElementById('konum-bul');
    
    // butona tıklandığında bunu yakalayalım
    button.onclick = function(){
  
        // tarayıcının destekleyip desteklemediğine bakalım
        if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(showPosition);
            // Eğer kullanıcı izin vermiş ise showPosition fonksiyonu çalışacak
           
            
        } else {
            x.innerHTML = "Geolocation tarayıcınızda desteklenmiyor.";
        }
       };

    // position ile gönderilen datayı alıyoruz
    function showPosition(position){
        
        /* sonuçları göstereceğimiz etiketi seçtik
document.getElementById('latitude').value=position.coords.latitude;
document.getElementById('longitude').position.coords.longitude;
        
   sonuçları etiketimizin içinde gösteriyoruz     */ 


   $("#latitude").val(position.coords.latitude);
  
   $("#longitude").val(position.coords.longitude);
   $("#aktif-etme").fadeIn(500);       var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                        };  map.setCenter(pos);
   }
   
   
   function initMap() {
          var map;
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 0,
                    lng: 0
                },
                zoom: 6
            });
         
    }  
</script>
 <!--   lokasyon bulma scripti bitiş -->
 <script>

</script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb5WFIX6H-Ea-p6hDZItAK1mGK_6_VwDs&callback=initMap">
    </script>

 <script>


$(function(){
	$("#ilce-select option").hide();
	$("#il-select").change(function(){
		$("#ilce-select option").hide();
		var slug = $("#il-select option:selected").attr("slug");
		if(slug){
			$("#ilce-select option[il-slug='"+slug+"']").show();
		}
	});
});



 $(function()
{

  $("#isemri-aktif-tablo").load("work-order-table.php");



    $("#yeni-isemri").click(function()
    {
      $("#isemri-aktif-tablo").fadeOut(500);
      $("#yeni-isemri-form").fadeIn(500);
      
      
    });
      
}
 )
</script>





    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Seçiniz.",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 10,
          placeholder: "Kaynak geometrisi seçin.",
          allowClear: true
        });
        $(".select2_multiple2").select2({
          maximumSelectionLength: 10,
          placeholder: "Personel ekleyin.",
          allowClear: true
        });
      });
    </script>


    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
        <?php include 'footer.php'; ?>
    