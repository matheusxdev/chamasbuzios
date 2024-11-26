<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/modalOrders.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/modalOrders.js?v=<?php echo time(); ?>"></script>
</head>

<div class="modalOrders">
    <div class="modalOrders-content">
        <div class="modalOrders-contentHeader">
            <span class="title">Seus pedidos</span>
            <button class="btnCloseModalOrders"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modalOrders-contentBody"></div>
    </div>
</div>