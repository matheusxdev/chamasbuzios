<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/listProducts-destinotourbuzios.css?v=<?php echo time(); ?>">
  <script src="<?php echo $base_url; ?>components/assets/listProducts-destinotourbuzios.js?v=<?php echo time(); ?>"></script>
</head>

<div class="boxPasseios" id="tours">
  <div class="boxTitle">Passeios</div>

  <div class="feed-content">
    <?php
        $queryPasseios = $conexao->prepare("SELECT * FROM products");
        $queryPasseios->execute(array());

        if($queryPasseios->rowCount()){
            $passeios = $queryPasseios->fetchAll(PDO::FETCH_ASSOC);

            for($p = 0; $p < sizeof($passeios); $p++):
                $passeioAtual = $passeios[$p];

                ?>
                    <div id="cardPasseio_<?php echo $passeioAtual["id"]; ?>" class="cardPasseio" idProduct="<?php echo $passeioAtual["id"]; ?>">
                        <div class="cardPasseio-header">
                            <img src="<?php echo $passeioAtual["img"]; ?>" alt="<?php echo $passeioAtual["name"]; ?>">
                        </div>

                        <div class="cardPasseio-content">
                            <span class="nameProduct"><?php echo $passeioAtual["name"]; ?></span>
                            <span class="descProduct"><?php echo $passeioAtual["description"]; ?></span>
                        </div>
                        <div class="cardPasseio-bottom">
                            <?php 
                                if($passeioAtual["type"] == "0"){
                                    ?>
                                        <button class="btnMoreInfo">
                                            <a href="https://api.whatsapp.com/send?phone=5522996855785&text=Ol%C3%A1,%20gostaria%20de%20alugar%20a%20lancha!" target="_blank" rel="noopener noreferrer">
                                                <span>Saber mais</span>
                                                <div class="icon"><i class="fa-brands fa-whatsapp"></i></div>
                                            </a>
                                        </button>
                                    <?php
                                }else{
                                    ?>
                                        <div class="boxPrices">
                                            <span class="priceProductAnt">R$<?php echo $passeioAtual["priceAnt"]; ?></span>
                                            <span class="pricePromoProduct">R$<?php echo $passeioAtual["pricePromo"]; ?></span>
                                        </div>

                                        <button class="addCart" id="addCart_<?php echo $passeioAtual["id"]; ?>" idProduct="<?php echo $passeioAtual["id"]; ?>" type="<?php echo $passeioAtual["type"]; ?>">
                                            <i idProduct="<?php echo $passeioAtual["id"]; ?>" class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                <?php
            endfor;
        }
    ?>
  </div>
</div>