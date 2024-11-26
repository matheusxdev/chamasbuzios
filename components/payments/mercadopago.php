<?php
    $dir = $_SERVER['DOCUMENT_ROOT'];
    include_once($dir."/components/config.php");

    if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){
      $ch = curl_init('https://api.mercadopago.com/v1/payments');
      curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
          'Content-Type: application/json',
          'Authorization: Bearer '.$configPayment["access_token"],
      ));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      //pendente floatval($priceTotal)
      $dados = array(
          'transaction_amount' => floatval($priceTotal),
          "description" => "".$nameProduct."",
          "payment_method_id" => "pix",
          "payer" => [
              "email" => "".$email."",
              "first_name" => "".$name."",
              "last_name" => "".$lastname."",
              "identification" => [
                  "type" => "CPF",
                  "number" => "".$cpf.""
              ],
              "address" => [
                  "zip_code" => "".$cep."",
                  "street_name" => null,
                  "street_number" => null,
                  "neighborhood" => null,
                  "city" => null,
                  "federal_unit" => null
              ]
          ]
      );

      $corpo = json_encode($dados);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $corpo);

      $response = curl_exec($ch);

      curl_close($ch);

      $result = json_decode($response);
      $result1 = get_object_vars($result);

      if($result1 == "" || $result1 == null || $result1 == false){
        ?>
          <div class="boxErr">
            <span>Ocorreu um erro, contacte o suporte</span>
          </div>
        <?php
      }else{
        $result1Object = $result1["point_of_interaction"];

        $statusOrder = $result1["status"];
        $priceOrder = $result1["transaction_amount"];
  
        $priceOrder = explode(".", $priceTotal);
        $priceOrder1 = $priceTotal[0].",00";
  
        $result2 = get_object_vars($result1Object);
        $result2Object = $result2["transaction_data"];
  
        $result3 = get_object_vars($result2Object);
  
        $qrCodeBase64 = $result3["qr_code_base64"];
        $copyQrCode = $result3["qr_code"];
        $urlOrder = $result3["ticket_url"];
  
        $idOrderApi = $result1["id"];
        $idOrderApi = strval($idOrderApi);
  
        $queryUpdate = $conexao->prepare("UPDATE orders SET idOrderApi = ? WHERE id = ? AND idUser = ?");
        $queryUpdate->execute(array($idOrderApi, $orderAtual["id"], $id));
  
        ?>
          <head>
            <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/mercadopago.css?v=<?php echo time(); ?>">
            <script src="<?php echo $base_url; ?>components/assets/mercadopago.js?v=<?php echo time(); ?>"></script>
          </head>
  
          <div class="boxSuccess">
              <div class="orderSpinner is-animating"></div>
              <span class="title">Parabéns, agora falta <br/> apenas 1 passo </span>
              <span class="info">Efetue o pagamento e retorne aqui </span>
              <span class="nOrder">#<?php echo $orderAtual["id"]; ?></span>
              
              <img class="imgQrOrder" src="data:image/png;base64, <?php echo $qrCodeBase64; ?>" alt="">
  
              <div class="copyCodeQrOrder">
                  <input type="text" id="copyCodeQrOrder" value="<?php echo $copyQrCode; ?>" disabled>
                  <button class="copyQrCodeOrder">
                    <div class="icon"><i class="fa-regular fa-copy"></i></div>
                    <span>Copiar</span>
                  </button>
              </div>
  
              <span class="priceOrder">R$<?php echo $priceTotal; ?></span>
  
              <button class="btnConfirmPayment" idOrder="<?php echo $orderAtual["id"]; ?>">
                <div class="icon"><i class="fa-regular fa-circle-check"></i></div>
                <span>Paguei</span>
              </button>
  
              <div class="barProgress">
                  <span class="title">Aguardando o pagamento...</span>
                  <div class="bar is-animating"></div>
              </div>
              <!--<script>consultPayment(<?php //echo $orderAtual["id"]; ?>)</script>-->
          </div>
        <?php
      }
    }else{
      ?>
        <div class="boxErr">
          <span>Sua sessão expirou! Faça login novamente</span>
        </div>
      <?php
    }
?>