<?php

require_once "../netting/baglan.php";
$isemrisor=$db->prepare("SELECT * FROM foton_workorder WHERE workorder_status=1");
$isemrisor->execute();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<div class="x_panel">

          <div class="row">
                  <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">


                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>İş No</th>
                          <th>Müşteri</th>
                          <th>Oluşturulma Tarihi</th>
                          <th></th>
                        

                        </tr>
                      </thead>
                      <tbody>
                      
                      <?php 
                      
                      while($isemricek=$isemrisor->fetch(PDO::FETCH_ASSOC))
                       
                        
                      {?>

                        <tr>
                          <td><?php echo $isemricek['workorder_isno']?></td>
                          <td><?php echo $isemricek['workorder_customer']?></td>
                          <td><?php echo $isemricek['workorder_rdate']?></td>
                          <td width="20"  ><center><a href="equipment-edit.php?equipment_id=<?php echo $cihazcek['equipment_id']?>" <button class="fa fa-pencil"></button> <?php echo "&nbsp; "?>
            <a href="../netting/islem.php?equipment_id=<?php echo $cihazcek['equipment_id']?>&islem=cihazsil"<button class="fa fa-trash"></button></center></td>

                        </tr>
                         
                      <?php   }
                      ?>
                      </tbody>
                    </table>

                  </div>

              </div>

                    

            </div>
          </div>
          </div>
</body>

</html>
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