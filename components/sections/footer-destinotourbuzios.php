<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/footer-destinotourbuzios.css?v=<?php echo time(); ?>">
</head>

<footer class="footer">
  <div class="footer-content">
    <div class="footer-section">
      <h3>Links Rápidos</h3>
      <ul>
        <li><a href="#home">Início</a></li>
        <li><a href="#tours">Produtos</a></li>
        <li><a href="#advantages">Por que nos escolher</a></li>
        <li><a href="#why">Quem somos</a></li>
      </ul>
    </div>
    
    <div class="footer-section">
      <h3>Formas de Pagamento</h3>
      <div class="payment-methods">
        <i class="fa-brands fa-pix"></i>
        <i class="fa-brands fa-cc-mastercard"></i>
        <i class="fa-brands fa-cc-visa"></i>
      </div>
    </div>
    
    <div class="footer-section">
      <img src="img/logo-white.png" alt="Logo Destino Tour" class="footer-logo">
    </div>
  </div>
  
  <div class="footer-bottom">
    <p>Desenvolvido por <a href="https://matheusxdev.com.br" target="_blank">Matheus Oliveira</a></p>
  </div>
</footer>