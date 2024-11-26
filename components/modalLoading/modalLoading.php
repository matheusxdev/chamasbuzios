<?php
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/modalLoading.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/modalLoading.js?v=<?php echo time(); ?>"></script>
</head>

<div class="modalLoading active">
    <img src="<?php echo $base_url; ?>img/logo.png" alt="logo restaurante chamas buzios" />
    <div class="loaderSplash"></div>
</div>