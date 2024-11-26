<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/navHeader.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/navHeader.js?v=<?php echo time(); ?>"></script>
</head>

<div class="navHeader">
  <div class="left">
      <button class="btnMenu"><i class="fa-solid fa-bars"></i></button>
      <img src="img/logo-white.png" alt="logo restaurante chamas buzios" />

      <button class="btnHome">
        <a rel="noreferrer noopener nofollow" href="#home">
          <div class="icon"><i class="fa-solid fa-house"></i></div>
          <span>Inicio</span>
        </a>
      </button>

      <button class="btnTours">
        <a rel="noreferrer noopener nofollow" href="#tours">
          <div class="icon"><i class="fa-solid fa-bus"></i></div>
          <span>Passeios</span>
        </a>
      </button>

      <button class="btnAdvantages">
        <a rel="noreferrer noopener nofollow" href="#advantages">
          <div class="icon"><i class="fa-solid fa-ranking-star"></i></div>
          <span>Vantagens</span>
        </a>
      </button>

      <button class="btnQuemSomos">
        <a rel="noreferrer noopener nofollow" href="#why">
          <div class="icon"><i class="fa-regular fa-circle-question"></i></div>
          <span>Quem somos</span>
        </a>
      </button>
  </div>

  <div class="right">
      <div class="boxSearch">
          <input type="text" style="display:none">
          <input type="password" style="display:none">
          <input type="search" id="inputSearch" autocomplete="off" placeholder="pesquise por pratos ou passeios" />
          <button class="btnSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>

      <button class="<?php if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){ echo "btnProfile"; }else{echo "btnLogin"; } ?>"><i class="fa-regular fa-circle-user"></i></button>

      <div class="boxCart">
          <button class="btnCart"><i class="fa-solid fa-cart-shopping"></i></button>
          
          <?php
              if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){
                  $queryCart = $conexao->prepare("SELECT * FROM cart WHERE idUser = ?");
                  $queryCart->execute(array($id));

                  if($queryCart->rowCount()){
                      $qtdCart = 0;
                      $carts = $queryCart->fetchAll(PDO::FETCH_ASSOC);

                      for($c = 0; $c < sizeof($carts); $c++):
                          $qtdCart++;    
                      endfor;
                  }else{
                      $qtdCart = 0;
                  }
              }else{
                  $qtdCart = 0;
              }
          ?>
          <span class="qtdCart"><?php echo $qtdCart; ?></span>
      </div>
  </div>
</div>