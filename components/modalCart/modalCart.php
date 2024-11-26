<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/modalCart.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/modalCart.js?v=<?php echo time(); ?>"></script>
</head>

<div class="modalCart">
    <div class="modalCart-content">
      <div class="modalCart-contentHeader">
        <button class="btnCloseModalCart">
              <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
              <span>Carrinho</span>
          </button>
      </div>

      <div class="modalCart-contentBody"></div>
    </div>
</div>