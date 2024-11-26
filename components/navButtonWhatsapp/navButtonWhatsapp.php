<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/navButtonWhatsapp.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/navButtonWhatsapp.js?v=<?php echo time(); ?>"></script>
</head>

<div class="navWhatsapp">
    <a href="https://api.whatsapp.com/send?phone=5522998736136&amp;text=Ol%C3%A1,%20quero%20fazer%20uma%20reserva" target="_blank" rel="noopener noreferrer"><img src="https://chamasbuzios.com.br/img/whatsapp.png" alt=""></a>
</div>