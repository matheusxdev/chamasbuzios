<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/modalOrderSuccess.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/modalOrderSuccess.js?v=<?php echo time(); ?>"></script>
</head>

<div class="modalOrderSuccess">
    <div class="modalOrderSuccess-content">
      <div class="modalOrderSuccess-contentHeader">
        <button class="btnCloseModalOrderSuccess">
              <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
              <span>Conclua seu pagamento</span>
          </button>
      </div>

      <div class="modalOrderSuccess-contentBody"></div>
    </div>
</div>