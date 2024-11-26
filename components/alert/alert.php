<?php
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/alert.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/alert.js?v=<?php echo time(); ?>"></script>
</head>

<div class="alert"></div>