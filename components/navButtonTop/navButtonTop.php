<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/navButtonTop.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/navButtonTop.js?v=<?php echo time(); ?>"></script>
</head>

<div class="navButtonTop">
    <button class="btnGoTop"><i class="fa-solid fa-arrow-up"></i></button>
</div>