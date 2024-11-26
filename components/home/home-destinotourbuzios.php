<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/home-destinotourbuzios.css?v=<?php echo time(); ?>">
</head>

<section class="hero" id="home">
    <div class="hero-content">
      <h1>Descubra as Maravilhas de Búzios</h1>
      <p>Embarque em uma jornada inesquecível pelas águas cristalinas e praias paradisíacas de Búzios. Nossos passeios de barco oferecem experiências únicas para toda a família.</p>
      <ul class="hero-features">
        <li><i class="fa-solid fa-ship"></i> Passeios de barco exclusivos</li>
        <li><i class="fa-solid fa-umbrella-beach"></i> Praias deslumbrantes</li>
        <li><i class="fa-solid fa-fish"></i> Mergulhos</li>
      </ul>
      <a href="#tours" class="cta-button">Explore Nossos Passeios</a>
    </div>
    <div class="hero-image">
      <img src="img/buzios-vista.jpg" alt="Vista panorâmica de Búzios">
      <div class="image-caption">
        <p>Descubra a beleza natural de Búzios conosco</p>
      </div>
    </div>
  </section>
</div>