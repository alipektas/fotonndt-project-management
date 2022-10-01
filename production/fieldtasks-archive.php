<?php include 'header.php'; 

//tabloya veri çekme aliser
$cihazsor=$db->prepare("SELECT * FROM foton_equipment WHERE equipment_status=1");
$cihazsor->execute();
$isemrisor=$db->prepare("SELECT * FROM foton_fieldtasks WHERE fieldtask_status=3 order by fieldtask_id DESC");
$isemrisor->execute();
$lokasyonsor=$db->prepare("SELECT * FROM foton_locations  where location_status=1");
$lokasyonsor->execute();

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2><b>Tamamlanmış Görevler</b><small></small></h2>

                    <div class="clearfix"></div>
            </div>
          <div class="row">
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>İş Emri No</th>
                          <th>Müşteri</th>
                          <th>Müteahhit</th>
                          <th>Saha Sorumlusu</th>
                          <th>Tamamlanma Tarihi</th>
                          <th></th>
                        

                        </tr>
                      </thead>
                      <tbody>
                      
                      <?php 
                      
                      while($isemricek=$isemrisor->fetch(PDO::FETCH_ASSOC))
                       
                        
                      {
                        $kullanicisor=$db->prepare("SELECT * FROM foton_users WHERE user_id=:user_id");
                        $kullanicisor->execute(array('user_id' => $isemricek['fieldtask_personal_res']));
                        $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
                  $musterisor=$db->prepare("SELECT * FROM foton_customers  where customer_id=:fieldtask_customer");
$musterisor->execute(array('fieldtask_customer' => $isemricek['fieldtask_customer']));
$mustericek=$musterisor->fetch(PDO::FETCH_ASSOC);
$muteahhitsor=$db->prepare("SELECT * FROM foton_customers  where customer_id=:fieldtask_subcontractor");
$muteahhitsor->execute(array('fieldtask_subcontractor' => $isemricek['fieldtask_subcontractor']));
$muteahhitcek=$muteahhitsor->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <tr>
                          <td><?php echo $isemricek['fieldtask_id']?></td>
                          <td><?php echo $mustericek['customer_name']?></td>
                          <td><?php echo $muteahhitcek['customer_name']?></td>
                          <td><?php echo $kullanicicek['user_name']?> <?php echo $kullanicicek['user_surname']?></td>
                          <td><?php echo $isemricek['fieldtask_date_finish']?></td>
                          <td width="20"  >
                          <form action="../netting/islem.php" method="POST" >
                          <input type="hidden" name="fieldtask_id" value="<?php echo $isemricek['fieldtask_id']?>">
                          <button type="submit" name="sahagorevarsiv" class="btn btn-primary"><i class="fa fa-folder"></i> Detay </button>
                          </form>
                          </td>

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
        </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->