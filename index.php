<?php 
    require("actions/conexao.php");

    $conexaoClass = new Conexao();
    $conexao = $conexaoClass->conectar();

    $dir = $_SERVER['DOCUMENT_ROOT'];
    include_once($dir."/components/config.php");
    $components = "modalLoading, alert, modalLogin";

    include_once($dir."/components/sessions/sessionUser.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uma nova experiência de gastronomia com turismo | Chamas Buzios</title>
  <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>" type="text/css" media="all" />
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
  <meta name="description" content="a melhor agência de turismo de búzios">
  <meta name="keywords" content="chamas, chamas buzios, chamas grill, buzios, agencia, destino tour buzios, destino tour, passeio de barco, passeios em buzios, turismo, agencia de turismo, agencia de turismo em armacao de buzios, destino tour búzios, passeio de destino, passeios em búzios">
  <meta name="robots" content="">
  <meta name="revisit-after" content="1 day">
  <meta name="language" content="Portuguese">
  <meta name="generator" content="N/A">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"">
  <link rel="canonical" href="https://chamasbuzios.com.br" /> 
  <meta property="og:title" content="Uma nova experiência de gastronomia com turismo | Chamas Buzios">
  <meta property="og:image" content="https://chamasbuzios.com.br/img/logo.png">
  <meta property="og:url" content="https://chamasbuzios.com.br">
  <meta property="og:site_name" content="Chamas Buzios">
  <meta property="og:type" content="website">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
  <script src="js/jquery-3.6.1.min.js"></script>
  <script src="js/jquery.mask.js"></script>
  <script src="js/index.js"></script>
  
  <?php if(str_contains($components, "modalLoading") == true){ ?> <script src="<?php echo $base_url; ?>/components/assets/modalLoading.js?v=<?php echo time(); ?>"></script> <?php } ?>
  <?php if(str_contains($components, "modalLogin") == true){ ?> <script src="<?php echo $base_url; ?>/components/assets/modalLogin.js?v=<?php echo time(); ?>"></script> <?php } ?>
</head>
<body>
  <?php include_once($dir."/components/modalLoading/modalLoading.php"); ?>
  <?php include_once($dir."/components/alert/alert.php"); ?>
  <?php include_once($dir."/components/navHeader/navHeader.php"); ?>
  <?php include_once($dir."/components/navButtonTop/navButtonTop.php"); ?>
  <?php include_once($dir."/components/navButtonWhatsapp/navButtonWhatsapp.php"); ?>

  <?php include_once($dir."/components/bannerHeader/bannerHeader.php"); ?>

  <div class="main" id=>
    <?php include_once($dir."/components/home/home-chamasbuzios.php"); ?>
    <?php include_once($dir."/components/listProducts/listProducts-chamasbuzios.php"); ?>

    <?php include_once($dir."/components/sections/sectionAdvantages-chamasbuzios.php"); ?>
    <?php include_once($dir."/components/sections/sectionWhy-chamasbuzios.php"); ?>

    <?php include_once($dir."/components/sections/footer-chamasbuzios.php"); ?>

    <?php if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){ include_once($dir."/components/modalProfile/modalProfile.php"); include_once($dir."/components/modalOrders/modalOrders.php"); include_once($dir."/components/modalCart/modalCart.php"); include_once($dir."/components/modalOrderSuccess/modalOrderSuccess.php"); }else{ include_once($dir."/components/modalLogin/modalLogin.php"); } ?>
    <?php include_once($dir."/components/modalPasseio/modalPasseio.php"); ?>
  </div>

  <script src="https://kit.fontawesome.com/b265def943.js" crossorigin="anonymous" rel="preload"></script>
</body>
</html>