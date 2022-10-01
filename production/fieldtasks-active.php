<?php include 'header.php'; 

//tabloya veri çekme aliser

$isemrisor=$db->prepare("SELECT * FROM foton_fieldtasks WHERE fieldtask_status=2");
$isemrisor->execute();


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
                    <h2><b>Aktif Görevler</b><small></small></h2>

                    <div class="clearfix"></div>
            </div>
          <div class="row">
                  <div class="x_content">


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
                  <div class="col-md-2 col-sm-2 col-xs-12 profile_details">
                        <div class="x_panel">
                          <div class="x_content">
                            <h4><i><strong>İş No: </strong><?php echo $isemricek['fieldtask_id']?></i></h4>
                            <div class="row">
                              <div class="x_content">
                                <h2><strong>Müşteri: </strong> <?php echo $mustericek['customer_name']?></h2>
                              </div>
                              <div class="x_content">
                              <p><strong>Sorumlu Kişi: </strong> <?php echo $kullanicicek['user_name']?> <?php echo $kullanicicek['user_surname']?> </p>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">

                            <div class="col-xs-12 col-sm-6 emphasis">
                                <a href="fieldtask-onduty.php?fieldtask_id=<?php echo $isemricek['fieldtask_id']?>" <button class="btn btn-round btn-dark"><div  class="fa fa-plus" style="color:#ffffff;"></i></div>Detay</button></a>
                            </div>
                          </div>
                        </div>
                      </div>

                  <?php } ?>
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
