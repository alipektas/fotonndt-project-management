<?php include 'header.php'; 

// veri çekme işlemleri
$deposor=$db->prepare("SELECT * FROM foton_warehouses where warehouse_id=:id");
$deposor->execute(array('id' => $_GET['warehouse_id']));
$depocek=$deposor->fetch(PDO::FETCH_ASSOC);
if($userget['user_aut'] != "Admin")
{
  header("location: profile.php?status=izinsizgiris");
}
else{} 
?>
<style type="text/css">
    #durum1 {display: none;}
    #durum2 {display: none;}
</style>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="col-md-1 col-sm-1 col-xs-6">
              <div id="durum1" class="alert alert-success">
					Güncellendi.
              </div>
              <div id="durum2" class="alert alert-danger">
					Güncelleme başarısız.
              </div>
          </div>
          <div class="x_title">
          <div class="clearfix"></div>
          <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
          <div class="x_title">
                    <h2>Depo Düzenleme<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                </div>
          <div class="row">
                  <div class="x_content">

                    <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Depo ID: <?php echo $depocek['warehouse_id']?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="hidden" name="warehouse_id"  value="<?php echo $depocek['warehouse_id']?>"  class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Depo Adı <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="warehouse_name" value="<?php echo $depocek['warehouse_name']?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Depo Tipi <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <select type="text" class="select2_single form-control" name="warehouse_type" required="required">
                          <option selected><?php echo $depocek['warehouse_type']?></option>
                          <option>Tip 1</option>
                          <option>Tip 2</option>
                          <option>Tip 3</option>
                          <option>Tip 4</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="warehouse_adress" value="<?php echo $depocek['warehouse_adress']?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="warehouses.php"><button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                          <button type="submit" name="depoguncelle" class="btn btn-success">Güncelle</button>
                        </div>
                      </div>
                    </form>
                      <!-- buranın üstü içerik divi --></div>
          </div>
          </div>
        </div>
        </div>
        </div>
        </div>
        <!-- /page content -->
        <?php 
                         if ($_GET['status']=="updated") { ?>
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
                         
                        ?>
        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->