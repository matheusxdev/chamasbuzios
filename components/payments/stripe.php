<?php
  $dir = $_SERVER['DOCUMENT_ROOT'];
  require($dir."/actions/conexao.php");
  include_once($dir."/components/config.php");
  require_once($dir.'/vendor/autoload.php');

  $conexaoClass = new Conexao();
  $conexao = $conexaoClass->conectar();

  date_default_timezone_set('America/Sao_Paulo');
  $timezone = new DateTimeZone('America/Sao_Paulo');
  $mysqldata  = new DateTime('now', $timezone);
  $data = $mysqldata->format("Y-m-d");
  $hour = $mysqldata->format("H:i:s");

  session_set_cookie_params(PHP_INT_MAX);
  session_start();

  function get_client_ip_user() {
      $ipaddress = '';
      if (isset($_SERVER['HTTP_CLIENT_IP']))
          $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
          $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_X_FORWARDED']))
          $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
      else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
          $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_FORWARDED']))
          $ipaddress = $_SERVER['HTTP_FORWARDED'];
      else if(isset($_SERVER['REMOTE_ADDR']))
          $ipaddress = $_SERVER['REMOTE_ADDR'];
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
  }

  $dispositive = $_SERVER['HTTP_USER_AGENT'];
  $ip = get_client_ip_user();

  $dir = $_SERVER['DOCUMENT_ROOT'];

  $queryConfig = $conexao->prepare("SELECT * FROM config_payment");
  $queryConfig->execute();

  if($queryConfig->rowCount() > 0){
      $configPayment = $queryConfig->fetchAll(PDO::FETCH_ASSOC)[0];
  }
  
  if($configPayment["developer"] == "0"){ $stripe_secrete_key = $configPayment["stripe_secret_key"]; }else{ $stripe_secrete_key =  $configPayment["stripe_secret_key_test"]; }

  \Stripe\Stripe::setApiKey($stripe_secrete_key);
  header('Content-Type: application/json');

  if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){
    $id = $_SESSION["userClient"][0];
    $idClientStripe = $_SESSION["userClient"][1];
    $name = $_SESSION["userClient"][2];
    $lastname = $_SESSION["userClient"][3];
    $country = $_SESSION["userClient"][4];
    $cpf = $_SESSION["userClient"][5];
    $cep = $_SESSION["userClient"][6];
    $email = $_SESSION["userClient"][7];
    $phone = $_SESSION["userClient"][8];
    $ip = $_SESSION["userClient"][9];
    $dispositive = $_SESSION["userClient"][10];
    $token = $_SESSION["userClient"][11];
    $dataUser = $_SESSION["userClient"][12];

    $queryClient = $conexao->prepare("SELECT * FROM clients WHERE id = ?");
    $queryClient->execute(array($id));
    $client = $queryClient->fetchAll(PDO::FETCH_ASSOC)[0];
    $idClientStripe = $client["idClientStripe"];

    if($idClientStripe == "0"){
        $customers = $stripe->customers->all(['limit' => 10])->data;

        for($e = 0; $e < sizeof($customers); $e++):
            $customer = $customers[$e]; 

            if($customer->email == $client["email"]){
                $idClientStripe = $customer->id;
                
                $queryUpdateUser = $conexao->prepare("UPDATE clients SET idClientStripe = ? WHERE id = ?");
                $queryUpdateUser->execute(array($idClientStripe, $id));
            }
        endfor;
    }

    $queryOrder = $conexao->prepare("SELECT * FROM orders WHERE idUser = ? ORDER BY id DESC limit 1");
    
    if($queryOrder->execute(array($id))){
        $orderAtual = $queryOrder->fetchAll(PDO::FETCH_ASSOC)[0];

        $adultos = $orderAtual["adultos"];
        $criancasPagantes = $orderAtual["criancasPagantes"];

        $totalVisitantes = $adultos.$criancasPagantes;

        $checkout_session = \Stripe\Checkout\Session::create([
          'line_items' => [
            [
              'price_data' => [
                'currency' => 'brl',
                'product_data' => ['name' => 'Reserva - Destino Tour Buzios'],
                'unit_amount' => $orderAtual["priceTotal"] * 100,
              ],
              'quantity' => 1,
            ]
          ],
          'customer' => $idClientStripe,
          'metadata' => [
            'id' => $orderAtual["id"]
          ],
          'mode' => 'payment',
          'success_url' => $base_url . 'success',
          'cancel_url' => $base_url . 'cancel',
        ]);

        $link = $checkout_session->url;
        $idCheckout = $checkout_session->id;

        $updateOrder = $conexao->prepare("UPDATE orders SET idOrderApi = ?, link = ? WHERE id = ?");
        $updateOrder->execute(array($idCheckout, $link, $orderAtual["id"]));

        header("HTTP/1.1 303 See Other");
        header("Access-Control-Allow-Origin: *");
        header("Location: " . $link);
    }
  }
?>