<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/modalProfile.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/modalProfile.js?v=<?php echo time(); ?>"></script>
</head>

<div class="modalProfile">
    <div class="modalProfile-content">
        <div class="modalProfile-contentHeader">
            <span class="name">Olá, <?php echo $name; ?></span>
            <button class="btnCloseModalProfile"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modalProfile-contentBody">
            <button class="btnMyData">
                <div class="icon"><i class="fa-regular fa-address-card"></i></div>
                <span>Meus dados</span>
            </button>

            <button class="btnOrders">
                <div class="icon"><i class="fa-regular fa-clipboard"></i></div>
                <span>Meus pedidos</span>
            </button>

            <button class="btnLogout">
                <div class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                <span>Sair</span>
            </button>
        </div>
    </div>
</div>