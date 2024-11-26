<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/bannerHeader.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/bannerHeader.js?v=<?php echo time(); ?>"></script>
</head>

<div class="bannerHeader">
  <div class="bannerHeader-content">
    <img class="slide slide1 active" src="<?php echo $base_url; ?>img/1.png" alt="">
    <img class="slide slide2" src="<?php echo $base_url; ?>img/2.png" alt="">
    <img class="slide slide3" src="<?php echo $base_url; ?>img/3.png" alt="">
    <img class="slide slide4" src="<?php echo $base_url; ?>img/4.png" alt="">
    <img class="slide slide5" src="<?php echo $base_url; ?>img/5.png" alt="">
  </div>
</div>