<?php
ob_start();
session_start();
include '../netting/baglan.php';


$admin="Admin";

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


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Foton NDT | Proje Yönetim </title>
    <script src="../production/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

  </head>
<style>
  #solgun {opacity: 0.5;}
</style>
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
            
              <a  href="profile.php" class="site_title"> <span>Foton NDT</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Hoşgeldin,</span>
                <h2><?php echo $userget['user_name']?>!</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                
                <ul class="nav side-menu">
                    
                <li><a href="profile.php"><i class="fa fa-user"></i>Profil</a></li>
                <li><a><i class="fa fa-truck"></i>Saha Görevleri<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fieldtask-new.php">Yeni Görev Planı</a></li>
                      <li><a href="fieldtasks.php">Planlanan Görevler</a></li>
                      <li><a href="fieldtasks-active.php">Aktif Görevler</a></li>
                      <li><a href="fieldtasks-archive.php">Tamamlanmış Görevler</a></li>
                    </ul>
                  </li>


<?php if ($userget['user_aut'] == $admin) 
{?>

                <li><a><i class="fa fa-briefcase"></i>Müşteri İşlemleri<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="customers.php">Müşteriler</a></li>
                      <li><a href="locations.php">Lokasyonlar</a></li>
                      <li><a href="projects.php">Projeler</a></li>
                    </ul>
                </li>

<?php } 
else
{ ?>
                <li><a><i class="fa fa-briefcase"></i>Müşteri İşlemleri<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li id="solgun"><a>Müşteriler</a></li>
                      <li id="solgun"><a>Lokasyonlar</a></li>
                      <li><a href="projects.php">Projeler</a></li>
                    </ul>
                </li>
<?php
}
?>

<?php if ($userget['user_aut'] == $admin) 
{?>
                <li><a><i class="fa fa-indent"></i>Ana Veriler<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="materials.php">Malzemeler</a></li>
                      <li><a href="equipment.php">Cihazlar</a></li>
                      <li><a href="vehicles.php">Araçlar</a></li>
                      <li><a href="warehouses.php">Depolar</a></li>
                      <li><a href="users.php">Kullanıcılar</a></li>
                    </ul>
                </li>
<?php } 
else
{ ?>
                <li id="solgun"><a><i class="fa fa-indent"></i>Ana Veriler<span class="fa fa-chevron-down"></span></a>

                </li>

<?php
}
?>
                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $userget['user_name']   ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.php"> Profil</a></li>

                  
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i>Güvenli Çıkış</a></li>
                  </ul>
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
     