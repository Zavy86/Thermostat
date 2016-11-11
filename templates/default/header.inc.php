<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo TEMPLATE; ?>images/favicon.ico">

  <title><?php echo $GLOBALS['config']->title." - ".ucwords(VIEW); ?></title>

  <!-- jQuery -->
  <script src="<?php echo TEMPLATE; ?>js/jquery-1.12.0.min.js"></script>

  <!-- Bootstrap -->
  <link href="<?php echo TEMPLATE; ?>css/bootstrap-3.3.5.min.css" rel="stylesheet">
  <script src="<?php echo TEMPLATE; ?>js/bootstrap-3.3.5.min.js"></script>

  <!-- Bootstrap Toggle -->
  <script src="<?php echo TEMPLATE; ?>js/bootstrap-toggle-2.2.0.min.js"></script>
  <link href="<?php echo TEMPLATE; ?>css/bootstrap-toggle-2.2.0.min.css" rel="stylesheet">

  <!-- Bootstrap Clock Picker -->
  <script src="<?php echo TEMPLATE; ?>js/bootstrap-clockpicker-0.0.7.min.js"></script>
  <link href="<?php echo TEMPLATE; ?>css/bootstrap-clockpicker-0.0.7.min.css" rel="stylesheet">

  <!-- Bootstrap Select -->
  <script src="<?php echo TEMPLATE; ?>js/bootstrap-select-1.10.0.min.js"></script>
  <link href="<?php echo TEMPLATE; ?>css/bootstrap-select-1.10.0.min.css" rel="stylesheet">

  <!-- Bootstrap Checkbox -->
  <link href="<?php echo TEMPLATE; ?>css/bootstrap-checkbox-1.0.0.min.css" rel="stylesheet">

  <!-- CSS -->
  <link href="<?php echo TEMPLATE; ?>css/style.css" rel="stylesheet">

  <!-- FIX per browser fuori standard -->
  <script src="<?php echo TEMPLATE; ?>js/ie10-viewport-bug-workaround.js"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
 </head>

 <body>

  <!-- navbar -->
  <nav class="navbar navbar-default navbar-static-top">
   <div class="container">
    <div class="navbar-header">

     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
     </button>

     <a class="navbar-brand" id="nav_brand_logo" href="#"><img alt="Brand" src="<?php echo TEMPLATE; ?>images/brand.png" width="20"></a>
     <a class="navbar-brand" id="nav_brand_title" href="index.php"><?php echo $GLOBALS['config']->title; ?></a>

    </div><!--/navbar-header -->

    <div id="navbar" class="navbar-collapse collapse">
     <ul class="nav navbar-nav">
      <li<?php if(VIEW=="overview"){echo " class='active'";} ?>><a href="index.php?view=overview">Overview</a></li>
      <li<?php if(substr(VIEW,0,17)=="heating_plannings"){echo " class='active'";} ?>><a href="index.php?view=heating_plannings_view">Planning</a></li>
      <li class="dropdown <?php if(substr(VIEW,-8)=="settings"){echo "active";} ?>">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
       <ul class="dropdown-menu">
        <li><a href="index.php?view=settings">Generals</a></li>
        <?php if(1){echo "<li><a href='index.php?view=heating_settings'>Heating system</a></li>\n";} ?>
       </ul>
      </li>

      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Extra <span class="caret"></span></a>
       <ul class="dropdown-menu">
        <li><a href="submit.php?act=system_shutdown&method=halt">Shutdown</a></li>
        <li><a href="submit.php?act=system_shutdown&method=restart">Restart</a></li>
        <li><a href="index.php?view=debug">Debug</a></li>
       </ul>
      </li>

      <?php if($_SERVER['REMOTE_ADDR']<>$_SERVER['SERVER_ADDR'] && $_SESSION['access']){ ?><li><a href="submit.php?act=session_logout">Logout</a></li><?php } ?>

     </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="#" id="nav_datetime"><?php include("now.inc.php"); ?></a></li>
     </ul>
    </div><!--/navbar-collapse -->

   </div><!--/container -->
  </nav>

  <!-- container -->
  <div class="container">

  <?php
   // @todo da cancellare
   if($_REQUEST['alert']){
    if(!$_REQUEST['alert_class']){$_REQUEST['alert_class']="info";}
    api_alerts_add($_REQUEST['alert'],$_REQUEST['alert_class']);
   }
   // show alerts
   if(count($_SESSION['alerts'])){
    echo "<div class='alerts'>\n";
    foreach($_SESSION['alerts'] as $alert){
     echo "<div class='alert alert-dismissible alert-".$alert->class."' role='alert'>";
     echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>\n";
     echo "<span>".$alert->message."</span>\n";
     echo "</div>\n";
    }
    echo "</div>\n";
    // reset session alerts
    $_SESSION['alerts']=array();
   }
  ?>
