<?php include 'header.php'; 
/* 
    status == 0 > silindi
    status == 1 > aktif/iş emri durumunda
    status == 2 > Saha görevinde
    status == 3 > Tamamlanmış/sonlandırılmış saha görevi

*/
//tabloya veri çekme aliser
$isemrisor=$db->prepare("SELECT * FROM foton_workorder WHERE workorder_status=1");
$isemrisor->execute();

$cihazsor=$db->prepare("SELECT * FROM foton_equipment WHERE equipment_status=1");
$cihazsor->execute();

$lokasyonsor=$db->prepare("SELECT * FROM foton_locations  where location_status=1");
$lokasyonsor->execute();

?>
<style type="text/css">
#yeni-isemri-form{display: none}
  </style>

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="x_title">
                    <h2><b>İş Emri</b><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
    
                    <button id="yeni-isemri" class="btn btn-round btn-dark btn-xs"><a  class="fa fa-plus" style="color:#ffffff;"></i></a> İş Emri Oluştur</button>
                     
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
            </div>
          <div id="isemri-aktif-tablo" class="col-md-12 col-sm-12 col-xs-12"></div>
        
          <div id="yeni-isemri-form" class="col-md-12 col-sm-12 col-xs-12">

                                <!-- yeni iş emri -->
                                <div class="x_content">
              <div class="x_title">
              <div align="center"><p> <h2><b>Yeni Kayıt</b><small></small></h2></p></div>
                    <div class="clearfix"></div>
            </div>
                        <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İş No <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="first-name" name="workorder_isno"  required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Müşteri/Lokasyon<span class="required">*</span></label>
  <div class="col-md-6 col-sm-9 col-xs-12">
    <select type="text" class="select2_single form-control" name="workorder_customer_location" required="required" tabindex="-1">
      <option></option>
      <?php 

while($lokasyoncek=$lokasyonsor->fetch(PDO::FETCH_ASSOC))
 
  
{?>
<option><?php echo $lokasyoncek['location_customer']?> - <?php echo $lokasyoncek['location_name']?></option>

<?php } ?>

    </select>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cihaz Seri No <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="first-name" name="workorder_equipment" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cihaz Enerji Seviyesi <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="first-name" name="workorder_equipment_energylevel" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Active Core Size <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="first-name" name="workorder_activecoresize" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Multiple</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <select type="text" class="select2_multiple form-control" multiple="multiple" name="workorder_personal" required="required">
      <option>Choose option</option>
      <option >Option one</option>
      <option>Option two</option>
      <option>Option three</option>
      <option>Option four</option>
      <option>Option five</option>
      <option>Option six</option>
    </select>
  </div>
</div>

<input type="hidden" name="equipment_creator" value="<?php echo $userget['user_id']?>">


<div class="ln_solid"></div>
<div class="form-group">
  <div align="right" class="col-md-6 col-sm-6 col-xs-12 ">
         <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
         <button type="submit" name="isemrikayit" class="btn btn-primary">Kaydet</button>

  </div>
  <br />
</div>
</form>
                        </div>
          </div>


        </div>
        </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
        <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
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
          placeholder: "Müşteri seçin.",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 10,
          placeholder: "En az bir personel seçmelisiniz.",
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
    <!-- /Datatables -->
