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
    <img class="slide slide1" src="<?php echo $base_url; ?>img/1.png" alt="">
  </div>
</div>