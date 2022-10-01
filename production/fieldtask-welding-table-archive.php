<?php
ob_start();
session_start();
include '../netting/baglan.php';
$z = $_GET['isno'];
$kaynaksor=$db->prepare("SELECT * FROM foton_fieldtask_weldings where fieldtask_welding_isno=:fieldtask_welding_isno and  fieldtask_welding_status=1 order by fieldtask_welding_id DESC");
$kaynaksor->execute(array('fieldtask_welding_isno' => $z));
$usercheck=$db->prepare("SELECT * FROM foton_users where user_mail=:mail");
$usercheck->execute(array('mail' => $_SESSION['user_mail']));
$count=$usercheck->rowCount();
$userget=$usercheck->fetch(PDO::FETCH_ASSOC);
/* izinsiz giriş için gerkli kod  */
if ($count==0)
{
  header("Location:login.php?durum=unaouthorized");
  exit;
}
?>
<!-- Bootstrap -->
    <div id="test">                                   
                       <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th width="20">Aksiyon</th>
                                  <th>Kaynak No</th>
                                  <th>Kaynak Bilgileri</th>
                                  <th>Filmler</th>                                  
                                </tr>
                              </thead>
                              <tbody>

                              <?php 
                      
                      while($kaynakcek=$kaynaksor->fetch(PDO::FETCH_ASSOC))
                       
                        
                      { 
                        
                        $malzemesor=$db->prepare("SELECT * FROM foton_fieldtask_welding_materials where welding_material_wno=:welding_material_wno and  welding_material_status=1 ");
                        $malzemesor->execute(array('welding_material_wno' => $kaynakcek['fieldtask_welding_id']));
                       ?> 
                        <input type="hidden" name="fieldtask_welding_id" value="<?php echo $kaynakcek['fieldtask_welding_id']?>">
                                <tr>
                                  <td><button type="button"  id="<?php echo $kaynakcek['fieldtask_welding_id']?>" class="btn btn-success kaynakdetay">Detay</button></td>
                                  <td><?php echo $kaynakcek['fieldtask_welding_no']?></td>
                                  <td>Test metodu: <?php echo $kaynakcek['fieldtask_welding_method']?></br></br>
                                  Çap: <?php echo $kaynakcek['fieldtask_welding_size']?></br></br>
                                  Metraj (mm): <?php echo $kaynakcek['fieldtask_welding_length']?></br></br>
                                  Kaynakçı: <?php echo $kaynakcek['fieldtask_welding_welderno']?></td>
                                  <td>
                                          <?php $total=0;
                                          while($malzemecek=$malzemesor->fetch(PDO::FETCH_ASSOC))
                                          { 
                                            $malzemeisimsor=$db->prepare("SELECT * FROM foton_materials where material_id=:welding_material_sid");
                                            $malzemeisimsor->execute(array('welding_material_sid' => $malzemecek['welding_material_sid']));
                                            $malzemeisimcek=$malzemeisimsor->fetch(PDO::FETCH_ASSOC);
                                            echo $malzemeisimcek['material_brand'];
                                            echo " ";
                                            echo $malzemeisimcek['material_dimension'];
                                            echo " - ";
                                            echo $malzemecek['welding_material_quantity'];
                                            echo " Adet";
                                            echo "</br>";
                                             $cur=$malzemecek['welding_material_quantity'];
                                             $total = $total + $cur;

                                            ?>
                                          <?php }
                                          echo "- - -";
                                          echo "</br>";
                                          echo "Toplam film adedi: ";
                                          echo $total; ?>
                                      </td>                                
                                </tr>
                     <?php } ?>

                              </tbody>
                       </table> 
    </div>
