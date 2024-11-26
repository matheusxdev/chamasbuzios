<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/modalPasseio.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.theme.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
  <script src="<?php echo $base_url; ?>components/assets/modalPasseio.js?v=<?php echo time(); ?>"></script>
</head>

<div class="modalPasseio">
    <div class="modalPasseio-header">
        <button class="closeModalPasseio">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Voltar</span>
        </button>
    </div>
    <div class="modalPasseio-content"></div>
</div>