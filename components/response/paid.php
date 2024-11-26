<?php
    ?>
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agência de turismo | Destino Tour Búzios</title>
        <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
        <meta name="description" content="a melhor agência de turismo de búzios">
        <meta name="keywords" content="buzios, agencia, destino tour buzios, destino tour, passeio de barco, passeios em buzios, turismo, agencia de turismo, agencia de turismo em armacao de buzios, destino tour búzios, passeio de destino, passeios em búzios">
        <meta name="robots" content="">
        <meta name="revisit-after" content="1 day">
        <meta name="language" content="Portuguese">
        <meta name="generator" content="N/A">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"">
        <link rel="canonical" href="https://destinotourbuzios.com.br" /> 
        <meta property="og:title" content="Agência de turismo | Destino Tour Buzios">
        <meta property="og:image" content="https://destinotourbuzios.com.br/img/logo.png">
        <meta property="og:url" content="https://destinotourbuzios.com.br">
        <meta property="og:site_name" content="Destino Tour Búzios">
        <meta property="og:type" content="website">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $base_url; ?>css/index.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/paid.css?v=<?php echo time(); ?>">
        <script src="<?php echo $base_url; ?>js/jquery-3.6.1.min.js"></script>
        <script src="<?php echo $base_url; ?>components/assets/paid.js?v=<?php echo time(); ?>"></script>
        <script src="https://kit.fontawesome.com/b265def943.js" crossorigin="anonymous" rel="preload"></script>
      </head>

      <div class="main">
        <div class="box">
          <div class="orderSpinner is-animating"></div>
        </div>

        <div class="box">
          <h1 class="title">Parabéns, seu voucher já está disponível!</h1>
          <h2 class="subtitle">Você pode vizualizar o seu voucher clicando no botão abaixo ou pelo e-mail que enviamos para você.</h2>
        </div>

        <div class="box boxInfo">
          <span class="info">Você receberá outros e-mails confirmando sua reserva e avisos sobre a reserva.</span>
        </div>

        <div class="box boxCta">
          <a href="<?php echo $base_url; ?>"><button class="btnGoHome">Voltar para o site</button></a>
          <button class="btnViewVoucher" idOrder="<?php echo $orderAtual["id"]; ?>"><span>Ver voucher</span></button>
        </div>
      </div>
    <?php
?>