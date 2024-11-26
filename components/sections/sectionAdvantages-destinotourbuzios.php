<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/sectionAdvantages-destinotourbuzios.css?v=<?php echo time(); ?>">
</head>

<div class="boxAdvantages" id="advantages">
  <div class="boxAdvantages-header">
    <h2 class="title">Por que escolher a Destino Tour Búzios?</h2>
    <p class="subtitle">Descubra as vantagens que fazem da Destino Tour a melhor escolha para suas aventuras</p>
  </div>

  <div class="boxAdvantages-content">
    <div class="box">
      <div class="icon"><i class="fa-regular fa-map"></i></div>
      <span>Melhores passeios</span>
      <p>Oferecemos uma seleção cuidadosa dos melhores roteiros e atrações turísticas</p>
    </div>

    <div class="box">
      <div class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
      <span>Melhores preços</span>
      <p>Garantimos tarifas competitivas e promoções exclusivas para nossos clientes</p>
    </div>

    <div class="box">
      <div class="icon"><i class="fa-regular fa-face-grin-squint"></i></div>
      <span>Satisfação 100% garantida</span>
      <p>Nosso compromisso é proporcionar experiências inesquecíveis e clientes felizes</p>
    </div>

    <div class="box">
      <div class="icon"><i class="fa-solid fa-users"></i></div>
      <span>Atendimento personalizado</span>
      <p>Nossa equipe está sempre pronta para atender suas necessidades e preferências</p>
    </div>

    <div class="box">
      <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
      <span>Segurança em primeiro lugar</span>
      <p>Priorizamos a segurança em todos os nossos passeios e atividades</p>
    </div>

    <div class="box">
      <div class="icon"><i class="fa-solid fa-earth-americas"></i></div>
      <span>Turismo sustentável</span>
      <p>Promovemos práticas de turismo responsável e respeito ao meio ambiente</p>
    </div>
  </div>

  <div class="boxAdvantages-footer">
    <a href="#tours" class="cta-button">Conheça nossos passeios</a>
  </div>
</div>