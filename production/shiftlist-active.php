<?php
ob_start();
session_start();
include '../netting/baglan.php';
$z = $_GET['id'];
$mesaisor=$db->prepare("SELECT * FROM foton_shifts where shift_creator=:shift_creator and  shift_status=1 order by shift_id DESC");
$mesaisor->execute(array('shift_creator' => $z));
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
                                  <th>Firma</th>
                                  <th>Mesai Aralığı</th>
                                  <th>Tarih</th>                                  
                                </tr>
                              </thead>
                              <tbody>

                              <?php 
                      
                      while($mesaicek=$mesaisor->fetch(PDO::FETCH_ASSOC))                  
                      {           
                       ?> 
                        <input type="hidden" name="shift_id" value="<?php echo $mesaicek['shift_id']?>">
                                <tr>
                                  <td><button type="button"  id="<?php echo $kaynakcek['fieldtask_welding_id']?>" class="btn btn-success kaynakdetay">Detay</button><button type="button" deger="<?php echo $kaynakcek['fieldtask_welding_no']?>" id="<?php echo $kaynakcek['fieldtask_welding_id']?>" class="btn btn-danger kaynaksil">Sil</button></td>
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
                                            echo "</br>";
                                             $cur=$malzemecek['welding_material_quantity'];
                                             $total = $total + $cur;

                                            ?>
                                          <?php }
                                          echo "</br>";
                                          echo "</br>";
                                          echo "Toplam film adedi: ";
                                          echo $total; ?>
                                      </td>                                
                                </tr>
                     <?php } ?>

                              </tbody>
                       </table> 
    </div>
