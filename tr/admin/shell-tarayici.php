﻿<title>WebCOP Firewall Yönetim Paneli</title>
<meta name="robots" content="noindex">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
error_reporting(0);
session_start();
if(!file_exists("../wcp_config.php")){
	header('Location: ../kurulum');
}
require_once __DIR__ . '/../wcp_config.php';
require_once __DIR__ . '/../lib/ip_al.php';
ini_set('session.cookie_httponly', 1);

// giris kontrol

if($_SESSION['wcpacp'] != "wcp-".$ip_adresi){
header('Location: index.php');
}else{
$uisorgu = $dbbaglan->query('SELECT * FROM ayar', PDO::FETCH_ASSOC);
if ( $uisorgu->rowCount() ){
foreach( $uisorgu as $ayartbl ){
if(file_get_contents("https://webcop.org/wcpfirewall/version.php")){
$wcpver = "V1";
if($wcpver != file_get_contents("https://webcop.org/wcpfirewall/version.php")){
echo "<script>var guncel = 'Yazılımınız güncel değil, en kısa zamanda yeni versiyonuyla güncellemelisiniz!'; alert(guncel);</script>";	
}
}
echo '
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WebCOP - Güvenlik Paneli</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="ltemp/html5shiv.min.js"></script>
  <script src="ltemp/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>W</b>CP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Web</b>COP</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Navigasyon</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
        
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">
			 </span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>'.strip_tags($ayartbl['adminadsoyad']).'</p>
          <a href="//'.strip_tags($_SERVER['SERVER_NAME']).'"><i class="fa fa-circle text-success"></i> '.strip_tags($_SERVER['SERVER_NAME']).'</a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigasyon</li>
        
		  <li>
          <a href="index.php">
            <i class="fa fa-home"></i> <span>Anasayfa</span>
          
          </a>
        </li>

		 <li class="treeview">
          <a href="#">
            <i class="fa fa-shield"></i> <span>Güvenlik</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="mirror-koruma.php"><i class="fa fa-circle-o"></i>Mirror - Zone Koruması</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Saldırgan İzleme
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="flood-saldirilari.php"><i class="fa fa-circle-o"></i> Flood Saldırıları</a></li>
                <li><a href="saldiri-girisimleri.php"><i class="fa fa-circle-o"></i> Saldırı Girişimleri</a></li>
              </ul>
            </li>
            <li><a href="saldirgan-engelleme.php"><i class="fa fa-circle-o"></i> Saldırgan Engelleme</a></li>
			<li><a href="shell-tarayici.php"><i class="fa fa-circle-o"></i> Shell Tarayıcı</a></li>
			<li><a href="anasayfa-guvenligi.php"><i class="fa fa-circle-o"></i> Anasayfa Güvenliği</a></li>
			<li><a href="guvenlik-robotu.php"><i class="fa fa-circle-o"></i> Güvenlik Robotu</a></li>
          </ul>
        </li>
		
				 <li class="treeview">
          <a href="#">
            <i class="fa fa-star"></i> <span>Ekstra</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="url-yonlendirme.php"><i class="fa fa-circle-o"></i>URL Yönlendirme</a></li>
            <li><a href="bakim-modu.php"><i class="fa fa-circle-o"></i>Bakım Modu</a></li>
			<li><a href="hacklenmis-miyim.php"><i class="fa fa-circle-o"></i>Hack\'lenmiş miyim?</a></li>
          </ul>
        </li>
		
        <li>
          <a href="https://infinitumit.com.tr">
            <i class="fa fa-envelope"></i> <span>Destek</span>
          
          </a>
        </li>
        
    
        <li><a href="https://www.cybermagonline.com"><i class="fa fa-book"></i> <span>Siber Güvenlik Dergisi</span></a></li>
        <li class="header">WebCOP Firewall</li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Shell Tarama
      </h1>
      
    </section>

    <!-- Main content -->
   
   
   
   
   
   
   
   
   
   
   <section class="content">
  
  <center>
			  
			  
  <div style="width: 70%" class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Shell Tarama</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Küçült">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Kapat">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div style="text-align: left; margin-left: 10px;" class="box-body">
		Sitenizin kök dizininde ('.$_SERVER['DOCUMENT_ROOT'].') veya sizin belirleyeceğiniz bir dizinde webshell taraması yaparak şüpheli dosyaları listeler. Dosyaların büyüklüğüne göre bu işlem biraz zaman alabilir.<br><br> 
		<form action="" method="post">';
if($_POST['calistir'] and $_POST['csrftoken'] == $_SESSION['csrftoken']){
echo 'İşte sonuç:<pre>';
$wcpdizincek = $ayartbl['dizinwcp'];

function klasortara($kokdizin, $tumveri=array()) {
    $harictut = array(".", "..");
    $dizinicerik = scandir($kokdizin);
    foreach($dizinicerik as $anahtar => $icerikgeldi) {
        $dizinney = $kokdizin.'/'.$icerikgeldi;
        if(!in_array($icerikgeldi, $harictut)) {
            if(is_file($dizinney) && is_readable($dizinney)) {
                $tumveri[] = $dizinney;
            }elseif(is_dir($dizinney) && is_readable($dizinney)) {
                $tumveri = klasortara($dizinney, $tumveri);
            }
        }
    }
    return $tumveri;
}
$dizincek = $_POST['dizingir'];
if($_POST['dizinyok'] and $_POST['sadecephp']){
$dosyalar = array();
foreach(klasortara($dizincek) as $isaretli){
if(!stristr($isaretli, $wcpdizincek) and stristr($isaretli, ".php")){
array_push($dosyalar, $isaretli);
}
}
}

if($_POST['dizinyok'] and !$_POST['sadecephp']){
$dosyalar = array();
foreach(klasortara($dizincek) as $isaretli){
if(!stristr($isaretli, $wcpdizincek)){
array_push($dosyalar, $isaretli);
}
}
}

if(!$_POST['dizinyok'] and $_POST['sadecephp']){
$dosyalar = array();
foreach(klasortara($dizincek) as $isaretli){
if(stristr($isaretli, ".php")){
array_push($dosyalar, $isaretli);
}
}
}

if(!$_POST['dizinyok'] and !$_POST['sadecephp']){
$dosyalar = klasortara($dizincek);
}




$dosyasay = count($dosyalar);
$filtre = array("symlink", "base64_", "exec", "system", "popen", "passthru", "posix_getpwuid", "proc_open", "cgi", "eval", "php_uname", "AnonGhost", "upload", "hack", "shell", "etc/passwd", "etc/shadow", "unescape", "charCode", "shell");
echo 'Tarama bitti, '.$dosyasay.' dosya tarandı. ';
$kume = array();
foreach($dosyalar as $x) {
    if (file_exists($x)) {
        $ac = fopen($x, "r");
        $icerik = @fread($ac, filesize($x));
        fclose($ac);
        foreach($filtre as $y) {
            if(stristr($icerik, $y)){
		  array_push($kume, $x);
            }


        }

    }
}
$sonuclar = array_unique($kume); 
$sonucsay = count($sonuclar);

if($sonucsay > 0){
echo $sonucsay.' dosya şüpheli bulundu:<br><br>';
foreach($sonuclar as $sonuclistele){
	echo "<li>".htmlspecialchars($sonuclistele)."</li>";
}
}else{
echo 'Hiç şüpheli dosya bulunamadı.';	
}





echo '</pre>'; 
}else{
$_SESSION['csrftoken'] = md5(rand());	
echo '<input type="hidden" name="csrftoken" value="'.$_SESSION['csrftoken'].'"><center>
<input type="text" name="dizingir" class="form-control" style="width: 40%" value="'.$_SERVER['DOCUMENT_ROOT'].'"><br>
<div class="custom-control custom-checkbox">
      <input name="dizinyok" type="checkbox" class="custom-control-input" checked id="customCheck1">
      <label class="custom-control-label" for="customCheck1">Firewall dizini taranmasın.</label>
	  </div>
<div class="custom-control custom-checkbox">
     &emsp;&nbsp;&nbsp;<input name="sadecephp" type="checkbox" class="custom-control-input" id="customCheck2">
      <label class="custom-control-label" for="customCheck2">Sadece PHP dosyalar taransın.</label>
    </div>
<input name="calistir" type="submit" style="width: 40%" class="btn bg-purple btn-flat margin" value="Taramayı Başlat"><br>
</center>';	
	
}
echo'
</form>		
        <!-- /.box-body -->
        <!-- /.box-footer-->
      
        </div>
        <!-- /.col -->
    
	  
	  
	  
	  </div></center>
  
    </section>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      V<b>1</b>
    </div>
    <strong>Copyright &copy; 2019 <a href="https://infinitumit.com.tr">InfinitumIT - Power of Integrated Security.</a></strong> Tüm hakları
    saklıdır.
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar\'s background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/Chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

';
}
}
}