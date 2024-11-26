<?php 
    error_reporting(0);
    
    require("conexao.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    Class SendMail{
        private $mail = null;

        public function settingsMail(){
            $this->mail = new PHPMailer(true);
            //$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mail->isSMTP();  
            $this->mail->Host = 'smtp.gmail.com';   
            $this->mail->SMTPAuth = true;  
            $this->mail->Username = 'oficiialstarsocial@gmail.com';   
            $this->mail->Password = 'pmplsgpetgigchtj';      
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    
            $this->mail->Port = 465;
            $this->mail->CharSet = "UTF-8";

            $this->mail->setFrom('oficiialstarsocial@gmail.com', 'Chamas Buzios');
            $this->mail->addReplyTo('suportestarsociial@gmail.com', 'Suporte');
        }

        public function sendMailCadSuccess($email, $name){
            $file = file_get_contents("templates/cadastro.html");
            $file = str_replace("[NAME]", $name, $file);

            try {
                $this->mail->addAddress($email);
                $this->mail->isHTML(true); 
                $this->mail->Subject = 'Seja bem vindo a Chamas Buzios';
                $this->mail->Body = $file;
                $this->mail->send();

                return true;
            } catch (Exception $e) {
                //echo "Mailer Error: {$this->mail->ErrorInfo}";
                return false;
            }
        }

        public function sendMailOrderSuccess($email, $order, $urlOrder, $cpf){
            $file = file_get_contents("templates/ordersuccess.html");
            $file = str_replace("[ORDER]", $order, $file);
            $file = str_replace("[URLORDER]", $urlOrder, $file);
            $file = str_replace("[EMAIL]", $email, $file);
            $file = str_replace("[CPF]", $cpf, $file);

            try {
                $this->mail->addAddress($email);
                $this->mail->isHTML(true); 
                $this->mail->Subject = 'Sua reserva está aqui!';
                $this->mail->Body = $file;
                $this->mail->send();

                return true;
            } catch (Exception $e) {
                //echo "Mailer Error: {$this->mail->ErrorInfo}";
                return false;
            }
        }

        public function sendMailVoucher($idVoucher, $nameProduct, $data_reserva, $hora_reserva, $linkVoucher, $email, $name){
            $file = file_get_contents("templates/voucher.html");
            $file = str_replace("[IDVOUCHER]", $idVoucher, $file);
            $file = str_replace("[NAME_PRODUCT]", $nameProduct, $file);
            $file = str_replace("[DATE]", $data_reserva, $file);
            $file = str_replace("[HOUR]", $hora_reserva, $file);
            $file = str_replace("[QRVOUCHER]", $linkVoucher, $file);
            $file = str_replace("[NAME]", $name, $file);

            try {
                $this->mail->addAddress($email);
                $this->mail->isHTML(true); 
                $this->mail->Subject = 'Confira seu voucher';
                $this->mail->Body = $file;
                $this->mail->send();

                return true;
            } catch (Exception $e) {
                //echo "Mailer Error: {$this->mail->ErrorInfo}";
                return false;
            }
        }
    }

    Class Actions extends SendMail{
      private $con = null;

      public function __construct($conexao){
          $this->con = $conexao;
          $this->settingsMail();
      }

      public function send(){
          if(empty($_POST) || $this->con == null){
              echo json_encode(array("err" => 1, "message" => "Ocorreu um erro com nossos servidores, tente novamente mais tarde"));
              return;
          }
          
          switch(true){
            //CLIENTES
            case(isset($_POST["type"]) && $_POST["type"] == "cadClient" && isset($_POST["name"]) && isset($_POST["lastname"]) && isset($_POST["country"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["pass"])):
              echo $this->cadClient($_POST["name"], $_POST["lastname"], $_POST["country"], $_POST["cpf"], $_POST["cep"], $_POST["email"], $_POST["phone"], $_POST["pass"]);
              break;

            case(isset($_POST["type"]) && $_POST["type"] == "loginClient" && isset($_POST["email"]) && isset($_POST["pass"])):
                echo $this->loginClient($_POST["email"], $_POST["pass"]);
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "logout"):
              echo $this->logout();
              break;
            // FIM

            //CART
            case(isset($_POST["type"]) && $_POST["type"] == "getNCart"):
                echo $this->getNCart();
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "getCart"):
              echo $this->getCart($_POST["affiliate"]);
              break;

            case(isset($_POST["type"]) && $_POST["type"] == "addCart" && isset($_POST["idProduct"])):
                echo $this->addCart($_POST["idProduct"], $_POST["adultos"], $_POST["criancasPagantes"], $_POST["criancasNaoPagantes"], $_POST["priceTotal"], $_POST["nomePasseio"], $_POST["dataReserva"], $_POST["hourReserva"]);
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "updateCart" && isset($_POST["idProduct"]) && isset($_POST["quantd"])):
                echo $this->updateCart($_POST["idProduct"], $_POST["quantd"]);
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "confirmOrder" && isset($_POST["idPayment"])):
                echo $this->confirmOrder($_POST["idPayment"]);
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "addOrder" && isset($_POST["idPayment"]) && isset($_POST["idProduct"]) && isset($_POST["dataReserva"]) && isset($_POST["priceTotal"])):                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                echo $this->addOrder($_POST["idPayment"], $_POST["idProduct"], $_POST["dataReserva"], $_POST["affiliate"], $_POST["priceTotal"]);
                break; 

            case(isset($_POST["type"]) && $_POST["type"] == "consultPaymentMP" && isset($_POST["idOrder"])):
                echo $this->consultPaymentMP($_POST["idOrder"]);
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "redirectStripe" && isset($_POST["idPayment"]) && isset($_POST["idOrder"])):
                echo $this->redirectStripe($_POST["idPayment"], $_POST["idOrder"]);
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "createVoucher" && isset($_POST["idOrder"])):
                echo $this->createVoucher($_POST["idOrder"]);
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "viewVoucher" && isset($_POST["idOrder"])):
                echo $this->viewVoucher($_POST["idOrder"]);
                break;
            //FIM

            //PASSEIOS
            case(isset($_POST["type"]) && $_POST["type"] == "getPasseio" && isset($_POST["idProduct"])):
              echo $this->getPasseio($_POST["idProduct"]);
              break;

            //PEDIDOS

            case(isset($_POST["type"]) && $_POST["type"] == "getOrders"):
                echo $this->getOrders();
                break;

            case(isset($_POST["type"]) && $_POST["type"] == "getOrder" && isset($_POST["idOrder"])):
                echo $this->getOrder($_POST["idOrder"]);
                break;
          }
      }

        //CLIENTES
        public function cadClient($name, $lastname, $country, $cpf, $cep, $email, $phone, $pass){
            $dir = $_SERVER['DOCUMENT_ROOT'];
            include_once($dir."/components/config.php");
            require_once($dir.'/vendor/autoload.php');

            $conexao = $this->con;

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
        
            $ip = get_client_ip_user();
            $dispositive = $_SERVER['HTTP_USER_AGENT'];

            date_default_timezone_set('America/Sao_Paulo'); 
            $mysqldata = new DateTime(); 
            $data = $mysqldata->format("Y-m-d H:i:s");

            $a = uniqid(rand());
            $tokenHashA = md5($a);

            $b = uniqid(rand());
            $tokenHashB = md5($b);

            $c = "starweb";
            $tokenHashC = password_hash($c.$a.$b, CRYPT_BLOWFISH);
            
            $tokenHashS = $tokenHashC;

            if($country != "br"){
                $cpf = "0";
                $cep = "0";
            }else{
                // Extrai somente os números
                $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
                
                // Verifica se foi informado todos os digitos corretamente
                if (strlen($cpf) != 11) {
                    return json_encode(array("err" => 1, "message" => "CPF invalido"));
                }

                // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
                if (preg_match('/(\d)\1{10}/', $cpf)) {
                    return json_encode(array("err" => 1, "message" => "CPF invalido"));
                }

                // Faz o calculo para validar o CPF
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf[$c] * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cpf[$c] != $d) {
                        return json_encode(array("err" => 1, "message" => "CPF invalido"));
                    }
                }
            }

            $queryExist = $conexao->prepare("SELECT * FROM clients WHERE email = ?");
            $queryExist->execute(array($email));

            if($queryExist->rowCount()){
                return json_encode(array("err" => 1, "message" => "Esse email já foi cadastrado! Faça login!"));
            }else{
                $query = $conexao->prepare("INSERT INTO clients (name, lastname, country, cpf, cep, email, phone, pass, ip, dispositive, token, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if($query->execute(array($name, $lastname, $country, $cpf, $cep, $email, $phone, password_hash($pass, CRYPT_BLOWFISH), $ip, $dispositive, $tokenHashS, $data))){
                    $queryUser = $conexao->prepare("SELECT * FROM clients WHERE email = ?");
                    $queryUser->execute(array($email));

                    if($queryUser->rowCount()){
                        $userLogin = $queryUser->fetchAll(PDO::FETCH_ASSOC)[0];

                        if($this->sendMailCadSuccess($userLogin["email"], $userLogin["name"])){
                            
                        }

                        $queryConfig = $conexao->prepare("SELECT * FROM config_payment");
                        $queryConfig->execute();

                        if($queryConfig->rowCount() > 0){
                            $configPayment = $queryConfig->fetchAll(PDO::FETCH_ASSOC)[0];
                        }

                        if($configPayment["developer"] == "0"){ $stripe_secrete_key = $configPayment["stripe_secret_key"]; }else{ $stripe_secrete_key =  $configPayment["stripe_secret_key_test"]; }

                        $stripe = new \Stripe\StripeClient($stripe_secrete_key);
                        $stripe->customers->create([
                            'name' => $userLogin["name"]." ".$userLogin["lastname"],
                            'email' => $userLogin["email"],
                            'phone' => $userLogin["phone"],
                            'shipping' => [
                                'name' => $userLogin["name"],
                                'phone' => $userLogin["phone"],
                                'address' => [
                                    'country' => $userLogin["country"],
                                    'postal_code' => $userLogin["cep"]
                                ]
                            ]
                        ]);

                        $customers = $stripe->customers->all(['limit' => 10])->data;

                        for($e = 0; $e < sizeof($customers); $e++):
                            $customer = $customers[$e]; 

                            if($customer->email == $userLogin["email"]){
                                $idClientStripe = $customer->id;
                                
                                $queryUpdateUser = $conexao->prepare("UPDATE clients SET idClientStripe = ? WHERE id = ?");
                                $queryUpdateUser->execute(array($idClientStripe, $userLogin["id"]));
                            }
                        endfor;


                        session_set_cookie_params(PHP_INT_MAX);
                        session_start();
                        $_SESSION["userClient"] = array($userLogin["id"], $userLogin["idClientStripe"], $userLogin["name"], $userLogin["lastname"], $userLogin["country"], $userLogin["cpf"], $userLogin["cep"], $userLogin["email"], $userLogin["phone"], $userLogin["ip"], $userLogin["dispositive"], $userLogin["token"], $userLogin["data"]);
                    }
                    
                    return json_encode(array("err" => 0, "message" => "Cadastrado com sucesso!"));
                }else{
                    return json_encode(array("err" => 1, "message" => "Ocorreu um erro ao cadastrar"));
                }
            }
        }

        public function loginClient($email, $pass){
            $conexao = $this->con;
            
            $query = $conexao->prepare("SELECT * FROM clients WHERE email = ?");
            $query->execute(array($email));
        
            //pegar ip
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
        
            $ip = get_client_ip_user();
            $dispositive = $_SERVER['HTTP_USER_AGENT'];

            date_default_timezone_set('America/Sao_Paulo'); 
            $mysqldata = new DateTime(); 
            $data = $mysqldata->format("Y-m-d H:i:s");

            $a = uniqid(rand());
            $tokenHashA = md5($a);

            $b = uniqid(rand());
            $tokenHashB = md5($b);

            $c = "starweb";
            $tokenHashC = password_hash($c.$a.$b, CRYPT_BLOWFISH);
            
            $tokenHashS = $tokenHashC;

            if($query->rowCount()){
                $userLogin = $query->fetchAll(PDO::FETCH_ASSOC)[0];

                if(password_verify($pass, $userLogin["pass"])){
                    $queryUpdate = $conexao->prepare("UPDATE clients SET ip = ?, dispositive = ?, token = ? WHERE email = ?");
                    if($queryUpdate->execute(array($ip, $dispositive, $tokenHashS, $email))){
                    session_set_cookie_params(PHP_INT_MAX);
                    session_start();

                    $_SESSION["userClient"] = array($userLogin["id"], $userLogin["idClientStripe"], $userLogin["name"], $userLogin["lastname"], $userLogin["country"], $userLogin["cpf"], $userLogin["cep"], $userLogin["email"], $userLogin["phone"], $userLogin["ip"], $userLogin["dispositive"], $userLogin["token"], $userLogin["data"]);

                    return json_encode(array("err" => 0, "message" => "Entrando..."));
                    }else{
                    return json_encode(array("err" => 1, "message" => "Ocorreu um erro ao entrar, tente novamente"));
                    }
                }else{
                    return json_encode(array("err" => 1, "message" => "Email e/ou senha inválidos"));
                }
            }else{
                return json_encode(array("err" => 1, "message" => "Email e/ou senha inválidos"));
            }
        }

        public function logout(){
            $conexao = $this->con;

            session_set_cookie_params(PHP_INT_MAX);
            session_start();

            if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){
                session_start();
                unset($_SESSION['userClient']);

                return json_encode(array("err" => 0, "message" => "Saindo..."));
            }else if(isset($_SESSION["user"]) && is_array($_SESSION["user"])){
                session_start();
                unset($_SESSION['user']);

                return json_encode(array("err" => 0, "message" => "Saindo..."));
            }
        }
        //FIM

        //CART
        public function getNCart(){
            $conexao = $this->con;

            date_default_timezone_set('America/Sao_Paulo'); 
            $mysqldata = new DateTime(); 
            $data = $mysqldata->format("Y-m-d H:i:s");

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
        
            $ip = get_client_ip_user();
            $dispositive = $_SERVER['HTTP_USER_AGENT'];

            session_set_cookie_params(PHP_INT_MAX);
            session_start();

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
        
                echo $qtdCart;
            }
        }

        public function getCart($affiliate){
            $conexao = $this->con;

            date_default_timezone_set('America/Sao_Paulo'); 
            $mysqldata = new DateTime(); 
            $data = $mysqldata->format("Y-m-d H:i:s");

            session_set_cookie_params(PHP_INT_MAX);
            session_start();

            $priceTotal = 0;
            $dispositive = $_SERVER['HTTP_USER_AGENT'];

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

                $query = $conexao->prepare("SELECT * FROM cart WHERE idUser = ?");
                $query->execute(array($id));

                if($query->rowCount()){
                    $productsCart = $query->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <div class="left">
                            <?php
                                $arrayProducts = [];

                                for($pc = 0; $pc < sizeof($productsCart); $pc++):
                                    $productCartAtual = $productsCart[$pc];   

                                    $dataReservaAtual = $productCartAtual["dataReserva"];
            
                                    $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                                    $queryProduct->execute(array($productCartAtual["idProduct"]));
            
                                    if($queryProduct->rowCount()){
                                        $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];
                                        $arrayProducts[] = $productAtual["id"];

                                        if($productAtual["category"] == "3"){
                                            $category = "prato";
                                        }else if($productAtual["category"] == "1"){
                                            $category = "reserva";
                                        }
                                        
                                        if($productAtual["category"] == "1"){
                                            $priceTotal += $productCartAtual["priceTotal"];
                                        }else{
                                            if($productAtual["pricePromo"] != "0"){
                                                $priceUnitProduct = $productAtual["pricePromo"];
                
                                                $priceVerify = explode(".", $priceUnitProduct);
                
                                                if(strlen($priceVerify[1]) == "2"){
                                                    $priceTotalAnt = $priceUnitProduct*intval($productCartAtual["quantd"]);
                                                    //$priceTotal = number_format($priceTotalAnt, 0, ',', '.');
                                                    $priceTotal += $priceTotalAnt;
                                                }else if(strlen($priceVerify[1]) >= "3"){
                                                    $priceUnitProduct = preg_replace('/[^0-9]/', '', $priceUnitProduct);
                                                    $priceTotalAnt = $priceUnitProduct*intval($productCartAtual["quantd"]);
                                                    $priceTotalAnt = preg_replace('/[^0-9]/', '', $priceTotalAnt);
                                                    //$priceTotalAnt = $priceTotal + priceTotalAnt;
                                                    $priceTotal += $priceTotalAnt;
                                                    //$priceTotal = number_format($priceTotal, 0, ',', '.');
                                                }
                                            }else{
                                                $priceUnitProduct = $productAtual["price"];
                
                                                $priceVerify = explode(".", $priceUnitProduct);
                
                                                if(strlen($priceVerify[1]) == "2"){
                                                    $priceTotalAnt = $priceUnitProduct*intval($productsCart["quantd"]);
                                                    //$priceTotal = number_format($priceTotalAnt, 0, ',', '.');
                                                    $priceTotal += $priceTotalAnt;
                                                }else if(strlen($priceVerify[1]) >= "3"){
                                                    $priceUnitProduct = preg_replace('/[^0-9]/', '', $priceUnitProduct);
                                                    $priceTotalAnt = $priceUnitProduct*intval($productsCart["quantd"]);
                                                    $priceTotalAnt = preg_replace('/[^0-9]/', '', $priceTotalAnt);
                                                    //$priceTotalAnt = $priceTotal + priceTotalAnt;
                                                    $priceTotal += number_format($priceTotalAnt, 0, ',', '.');
                                                }
                                            }
                                        }
            
                                        ?>
                                            <div class="cardProductCart" id="cardProductCart_<?php echo $productAtual["id"]; ?>" idProduct="<?php echo $productAtual["id"]; ?>">
                                                <div class="cardProductCart-header">
                                                    <img src="<?php echo $productAtual["img"]; ?>" alt="">
                                                    
                                                    <div class="quantdTotal"><?php echo $productCartAtual["quantd"]; ?></div>
                                                </div>
            
                                                <div class="cardProductCart-body">
                                                    <span class="nameProduct"><?php echo $productAtual["name"]; ?></span>
            
                                                    <div class="boxPrices">
                                                        <?php
                                                            if($productAtual["pricePromo"] != "0"){
                                                        ?>
                                                                <span class="priceProductAnt">R$<?php echo $productAtual["priceAnt"]; ?></span>
                                                                <span class="pricePromoProduct">R$<?php echo $productAtual["pricePromo"]; ?></span>
                                                        <?php
                                                            }else if($productAtual["pricePromo"] == "0"){
                                                        ?>
                                                                <span class="priceProduct">R$<?php echo $productAtual["priceAnt"]; ?></span>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>

                                                    <?php
                                                        if($productAtual["category"] == "1"){
                                                            ?>
                                                                <div class="infoPersons">
                                                                    <i class="fa-solid fa-user"></i><span class="quantdPersons"><?php echo $productCartAtual["adultos"]+$productCartAtual["criancasPagantes"]+$productCartAtual["criancasNaoPagantes"]; ?></span>
                                                                </div>

                                                                <div class="infoDateReserva">
                                                                    <i class="fa-solid fa-calendar-days"></i><span class="infoDateReserva"><?php echo implode('/',array_reverse(explode('-',$productCartAtual["dataReserva"]))); ?></span>
                                                                </div>

                                                                <div class="infoHourReserva">
                                                                    <?php
                                                                        if($productCartAtual["horaReserva"] != "00:00:00"){
                                                                        ?>
                                                                            <i class="fa-regular fa-clock"></i><span class="infoHourReserva"><?php echo $productCartAtual["horaReserva"]; ?></span>
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                            <?php  
                                                        }
                                                    ?>
                                                </div>
            
                                                <div class="cardProductCart-bottom">
                                                    <?php
                                                        if($productAtual["category"] == 1){
                                                            ?>
                                                                <button class="deleteProductCart" id="deleteProductCart_<?php echo $productAtual["id"]; ?>" idProduct="<?php echo $productAtual["id"]; ?>"><i class="fa-solid fa-trash"></i></button>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <div class="boxAlterQuantd">
                                                                <button class="alterSubQuantdProduct" idProduct="<?php echo $productAtual["id"]; ?>" priceUnitProduct="<?php if($productAtual["pricePromo"] != "0"){ echo $productAtual["pricePromo"]; }else{ echo $productAtual["price"]; } ?>" priceTotal="<?php echo $priceTotal; ?>"><i class="fa-solid fa-minus"></i></button>
                                                                <span class="spanQuantdProduct" id="spanQuantdProduct_<?php echo $productAtual["id"]; ?>"><?php echo $productCartAtual["quantd"]; ?></span>
                                                                <button class="alterSomQuantdProduct" idProduct="<?php echo $productAtual["id"]; ?>" priceUnitProduct="<?php if($productAtual["pricePromo"] != "0"){ echo $productAtual["pricePromo"]; }else{ echo $productAtual["price"]; } ?>" priceTotal="<?php echo $priceTotal; ?>"><i class="fa-solid fa-plus"></i></button>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                endfor;
                            ?>
                        </div>

                        <div class="right">
                            <?php
                                if($category == "prato"){
                                    ?>
                                        <div class="boxReservarBottom active">
                                            <div class="boxReservarBottom-left">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span class="spanDateReservaBottom">Escolha a data da sua reserva</span>
                                            </div>

                                            <div class="boxReservarBottom-right">
                                                <i class="fa-solid fa-circle-chevron-right"></i>
                                            </div>
                                        </div>

                                        <div class="modalReservaBottom">
                                            <div class="modalReservaBottom-header">
                                                <span>Reservar</span>
                                            </div>
                                            <div class="modalReservaBottom-content">
                                                <div class="modalReservaBottom-contentBody">
                                                    <input type="date" id="inputReservaBottom" />
                                                </div>
                                            </div>
                                            <div class="modalReservaBottom-bottom">
                                                    <button class="closeModalReservaBottom">Fechar</button>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>

                            <div class="modalCart-bottom">
                                <?php
                                    if($affiliate != "0"){
                                        $queryAffiliate = $conexao->prepare("SELECT * FROM affiliates WHERE cupomAffiliate = ?");
                                        $queryAffiliate->execute(array($affiliate));

                                        if($queryAffiliate->rowCount()){
                                            $affiliateAtual = $queryAffiliate->fetchAll(PDO::FETCH_ASSOC)[0];

                                            $priceTotal = $priceTotal-$affiliateAtual["priceDiscount"];
                                            ?>
                                                <div class="box">
                                                    <div class="boxPriceDiscount">
                                                        <span class="title">Cupom de desconto:</span>
                                                        <span class="discount">- R$<?php echo $affiliateAtual["priceDiscount"]; ?></span>
                                                    </div>

                                                    <div class="boxPriceTotal">
                                                        <span class="titlePriceTotal">Preço total:</span>
                                                        <span class="priceTotal">R$<?php echo $priceTotal; ?></span>
                                                    </div>
                                                </div>
                                            <?php
                                        }else{
                                            ?>
                                                <div class="boxPriceTotal">
                                                    <span class="titlePriceTotal">Preço total:</span>
                                                    <span class="priceTotal">R$<?php echo $priceTotal; ?></span>
                                                </div>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <div class="boxPriceTotal">
                                                <span class="titlePriceTotal">Preço total:</span>
                                                <span class="priceTotal">R$<?php echo $priceTotal; ?></span>
                                            </div>
                                        <?php
                                    }
                                ?>

                                <button class="continueCart" dataReserva="<?php echo $dataReservaAtual; ?>">
                                    <span>Comprar</span>
                                    <div class="icon">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </button>
                            </div>

                            <div class="methodsPayment">
                                <div class="methodsPayment-content">
                                    <div class="methodsPayment-contentHeader">
                                        <button class="btnCloseModalMethodsPayment">
                                            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                                            <span>Método de pagamento</span>
                                        </button>
                                    </div>

                                    <div class="methodsPayment-contentBody">
                                        <div class="boxErrPayment"></div>

                                        <div class="boxPayment boxPix" payment="1">
                                            <i class="fa-brands fa-pix" aria-hidden="true"></i>
                                            <span>Pix</span>
                                        </div>

                                        <div class="boxPayment boxCardCredit" payment="2">
                                            <i class="fa-regular fa-credit-card" aria-hidden="true"></i>
                                            <span>Cartão</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modalConfirmOrder">
                                <div class="modalConfirmOrder-content">
                                    <div class="modalConfirmOrder-contentHeader">
                                        <button class="btnCloseModalConfirmOrder">
                                            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                                            <span>Confirmar pedido</span>
                                        </button>
                                    </div>

                                    <div class="modalConfirmOrder-contentBody"></div>
                                </div>

                                <div class="modalConfirmOrder-bottom">
                                    <button class="continueOrder" dataReserva="<?php echo $dataReservaAtual; ?>" priceTotal="<?php echo $priceTotal; ?>" idProduct="<?php echo implode(",", $arrayProducts); ?>" affiliate="0">
                                        <span>Confirmar</span>
                                        <div class="icon">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php
                }else{
                    ?>
                        <div class="boxErr">
                            <span class="title">Ainda não tem produtos no carrinho!</span>
                        </div>
                    <?php
                }
            }else{
                echo "401";
            }
        }

        public function addCart($idProduct, $adultos, $criancasPagantes, $criancasNaoPagantes, $priceTotal, $nomePasseio, $dataReserva, $hourReserva){
            $conexao = $this->con;

            session_set_cookie_params(PHP_INT_MAX);
            session_start();

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

                date_default_timezone_set('America/Sao_Paulo'); 
                $mysqldata = new DateTime(); 
                $data = $mysqldata->format("Y-m-d H:i:s");

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
            
                $ip = get_client_ip_user();
                $dispositive = $_SERVER['HTTP_USER_AGENT'];

                $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                $queryProduct->execute(array($idProduct));

                if($queryProduct->rowCount()){
                    $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];

                    $price = $productAtual["priceAnt"];
                    $pricePromo = $productAtual["pricePromo"];

                    if($productAtual["category"] == 1){
                        $category = "reserva";
                    }else if($productAtual["category"] == 2){
                        $category = "prato";
                        if($pricePromo != "0"){ $priceTotal = $pricePromo; }else if($price != "0"){ $priceTotal = $price;}
                    }

                    if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){
                        $query = $conexao->prepare("SELECT * FROM cart WHERE idProduct = ? AND idUser = ?");
                        $query->execute(array($idProduct, $id));
                    }else{
                        echo json_encode(array("err" => 401, "message" => "Unauthorized"));
                    }

                    if($query->rowCount()){
                        $cartAtual = $query->fetchAll(PDO::FETCH_ASSOC)[0];

                        //verificar categoria
                        if($cartAtual["category"] == "reserva"){
                            echo json_encode(array("err" => 1, "message" => "Já existe uma reserva no carrinho"));
                        }else if($cartAtual["category"] == "prato"){
                            if($productAtual["category"] == 2){
                                if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){
                                    $queryCart = $conexao->prepare("UPDATE cart SET quantd = ? WHERE idProduct = ? AND idUser = ?");
                                    if($queryCart->execute(array($cartAtual["quantd"]+1, $productAtual["id"], $id))){
                                        echo json_encode(array("err" => 0, "message" => "Adicionado ao carrinho"));
                                    }else{
                                        echo json_encode(array("err" => 1, "message" => "Erro ao adicionar ao carrinho"));
                                    }
                                }else{
                                    echo json_encode(array("err" => 401, "message" => "Unauthorized"));
                                }
                            }
                        }
                    }else{
                        if($productAtual["category"] == "1"){
                            if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){
                                $queryRemove = $conexao->prepare("DELETE FROM cart WHERE idUser = ?");
                                if($queryRemove->execute(array($id))){
                                    $queryCart = $conexao->prepare("INSERT INTO cart (idUser, idProduct, name, quantd, adultos, criancasPagantes, criancasNaoPagantes, priceTotal, category, dataReserva, horaReserva, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                    if($queryCart->execute(array($id, $idProduct, $nomePasseio, 1, $adultos, $criancasPagantes, $criancasNaoPagantes, $priceTotal, $category, $dataReserva, $hourReserva, $data))){
                                        echo json_encode(array("err" => 0, "message" => "Adicionado ao carrinho"));
                                    }else{
                                        echo json_encode(array("err" => 1, "message" => "Erro ao adicionar ao carrinho"));
                                    }
                                }else{
                                    echo json_encode(array("err" => 1, "message" => "Erro ao adicionar ao carrinho"));
                                }
                            }else{
                                echo json_encode(array("err" => 401, "message" => "Unauthorized"));
                            }
                        }else if($productAtual["category"] == "2"){
                            if(isset($_SESSION["user"]) && is_array($_SESSION["user"])){
                                $queryRemove = $conexao->prepare("DELETE FROM cart WHERE idUser = ? AND category = ?");
                                if($queryRemove->execute(array($id, "reserva"))){
                                    $queryCart = $conexao->prepare("INSERT INTO cart (idUser, idProduct, name, quantd, priceTotal, category, data) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                    if($queryCart->execute(array($id, $idProduct, name, 1, $priceTotal, $category, $data))){
                                        echo json_encode(array("err" => 0, "message" => "Adicionado ao carrinho"));
                                    }else{
                                        echo json_encode(array("err" => 1, "message" => "Erro ao adicionar ao carrinho"));
                                    }
                                }else{
                                    echo json_encode(array("err" => 1, "message" => "Erro ao adicionar ao carrinho"));
                                }
                            }else{
                                echo json_encode(array("err" => 401, "message" => "Unauthorized"));
                            }
                        }
                    }
                }
            }else{
                echo json_encode(array("err" => 401, "message" => "Unauthorized"));
            }
        }

        public function updateCart($idProduct, $quantd){
            $conexao = $this->con;

            date_default_timezone_set('America/Sao_Paulo'); 
            $mysqldata = new DateTime(); 
            $data = $mysqldata->format("Y-m-d H:i:s");

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

            $ip = get_client_ip_user();
            $dispositive = $_SERVER['HTTP_USER_AGENT'];

            session_set_cookie_params(PHP_INT_MAX);
            session_start();

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

                $query = $conexao->prepare("SELECT * FROM cart WHERE idUser = ? AND idProduct = ?");
                $query->execute(array($id, $idProduct));

                if($query->rowCount()){
                    $productCartAtual = $query->fetchAll(PDO::FETCH_ASSOC)[0];

                    $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                    $queryProduct->execute(array($idProduct));

                    if($queryProduct->rowCount()){
                        $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];

                        if($productAtual["pricePromo"] != "0"){
                            $priceUnitProduct = $productAtual["pricePromo"];
                        }else{
                            $priceUnitProduct = $productAtual["price"];
                        }

                        if($quantd == "0"){
                            $updateCart = $conexao->prepare("DELETE FROM cart WHERE idUser = ? AND idProduct = ?");
                            if($updateCart->execute(array($id, $productAtual["id"]))){
                                echo "delete";
                            }
                        }else if($quantd >= "1"){
                            $priceVerify = explode(".", $priceUnitProduct);

                            if(strlen($priceVerify[1]) == "2"){
                                $priceTotalAnt = $priceUnitProduct*intval($quantd);
                                $priceTotalNew = $priceTotalAnt;
                            }else{
                                $priceUnitProduct = preg_replace('/[^0-9]/', '', $priceUnitProduct);
                                $priceTotal = $priceUnitProduct*intval($quantd);
                                $priceTotal = preg_replace('/[^0-9]/', '', $priceTotal);
                                $priceTotalNew = number_format($priceTotal, 0, ',', '.');
                            }

                            $updateCart = $conexao->prepare("UPDATE cart SET quantd = ?, priceTotal = ? WHERE idUser = ? AND idProduct = ?");
                            if($updateCart->execute(array($quantd, $priceTotalNew, $id, $productAtual["id"]))){
                                echo "update";
                            }
                        }
                    }
                }
            }
        }

        public function confirmOrder($idPayment){
            $conexao = $this->con;

            date_default_timezone_set('America/Sao_Paulo'); 
            $mysqldata = new DateTime(); 
            $data = $mysqldata->format("Y-m-d H:i:s");

            session_set_cookie_params(PHP_INT_MAX);
            session_start();

            $priceTotal = 0;
            $dispositive = $_SERVER['HTTP_USER_AGENT'];

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

                $query = $conexao->prepare("SELECT * FROM cart WHERE idUser = ?");
                $query->execute(array($id));

                if($query->rowCount()){
                    $productsCart = $query->fetchAll(PDO::FETCH_ASSOC);
                    
                    $arrayProducts = [];

                    ?>
                        <div class="boxCardProducts">
                            <div class="boxCardProducts-header">
                                <div class="icon"><i class="fa-solid fa-circle-info"></i></div>
                                <span>Produtos</span>
                            </div>
                            <div class="boxCardProducts-content">
                                <?php
                                    for($pc = 0; $pc < sizeof($productsCart); $pc++):
                                        $productCartAtual = $productsCart[$pc];   
                
                                        $dataReservaAtual = $productCartAtual["dataReserva"];
                
                                        $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                                        $queryProduct->execute(array($productCartAtual["idProduct"]));
                
                                        if($queryProduct->rowCount()){
                                            $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];
                                            $arrayProducts[] = $productAtual["id"];
                
                                            if($productAtual["category"] == "3"){
                                                $category = "prato";
                                            }else if($productAtual["category"] == "1"){
                                                $category = "reserva";
                                            }
                                            
                                            if($productAtual["category"] == "1"){
                                                $priceTotal += $productCartAtual["priceTotal"];
                                            }else{
                                                if($productAtual["pricePromo"] != "0"){
                                                    $priceUnitProduct = $productAtual["pricePromo"];
                    
                                                    $priceVerify = explode(".", $priceUnitProduct);
                    
                                                    if(strlen($priceVerify[1]) == "2"){
                                                        $priceTotalAnt = $priceUnitProduct*intval($productCartAtual["quantd"]);
                                                        //$priceTotal = number_format($priceTotalAnt, 0, ',', '.');
                                                        $priceTotal += $priceTotalAnt;
                                                    }else if(strlen($priceVerify[1]) >= "3"){
                                                        $priceUnitProduct = preg_replace('/[^0-9]/', '', $priceUnitProduct);
                                                        $priceTotalAnt = $priceUnitProduct*intval($productCartAtual["quantd"]);
                                                        $priceTotalAnt = preg_replace('/[^0-9]/', '', $priceTotalAnt);
                                                        //$priceTotalAnt = $priceTotal + priceTotalAnt;
                                                        $priceTotal += $priceTotalAnt;
                                                        //$priceTotal = number_format($priceTotal, 0, ',', '.');
                                                    }
                                                }else{
                                                    $priceUnitProduct = $productAtual["price"];
                    
                                                    $priceVerify = explode(".", $priceUnitProduct);
                    
                                                    if(strlen($priceVerify[1]) == "2"){
                                                        $priceTotalAnt = $priceUnitProduct*intval($productsCart["quantd"]);
                                                        //$priceTotal = number_format($priceTotalAnt, 0, ',', '.');
                                                        $priceTotal += $priceTotalAnt;
                                                    }else if(strlen($priceVerify[1]) >= "3"){
                                                        $priceUnitProduct = preg_replace('/[^0-9]/', '', $priceUnitProduct);
                                                        $priceTotalAnt = $priceUnitProduct*intval($productsCart["quantd"]);
                                                        $priceTotalAnt = preg_replace('/[^0-9]/', '', $priceTotalAnt);
                                                        //$priceTotalAnt = $priceTotal + priceTotalAnt;
                                                        $priceTotal += number_format($priceTotalAnt, 0, ',', '.');
                                                    }
                                                }
                                            }
                
                                            ?>
                                                <div class="cardProductCart" id="cardProductCart_<?php echo $productAtual["id"]; ?>" idProduct="<?php echo $productAtual["id"]; ?>">
                                                    <div class="cardProductCart-header">
                                                        <img src="<?php echo $productAtual["img"]; ?>" alt="">
                                                        
                                                        <div class="quantdTotal"><?php echo $productCartAtual["quantd"]; ?></div>
                                                    </div>
                
                                                    <div class="cardProductCart-body">
                                                        <span class="nameProduct"><?php echo $productAtual["name"]; ?></span>
                
                                                        <div class="boxPrices">
                                                            <?php
                                                                if($productAtual["pricePromo"] != "0"){
                                                            ?>
                                                                    <span class="priceProductAnt">R$<?php echo $productAtual["priceAnt"]; ?></span>
                                                                    <span class="pricePromoProduct">R$<?php echo $productAtual["pricePromo"]; ?></span>
                                                            <?php
                                                                }else if($productAtual["pricePromo"] == "0"){
                                                            ?>
                                                                    <span class="priceProduct">R$<?php echo $productAtual["priceAnt"]; ?></span>
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>
                
                                                        <?php
                                                            if($productAtual["category"] == "1"){
                                                                ?>
                                                                    <div class="infoPersons">
                                                                        <i class="fa-solid fa-user"></i><span class="quantdPersons"><?php echo $productCartAtual["adultos"]+$productCartAtual["criancasPagantes"]+$productCartAtual["criancasNaoPagantes"]; ?></span>
                                                                    </div>
                
                                                                    <div class="infoDateReserva">
                                                                        <i class="fa-solid fa-calendar-days"></i><span class="infoDateReserva"><?php echo implode('/',array_reverse(explode('-',$productCartAtual["dataReserva"]))); ?></span>
                                                                    </div>
                
                                                                    <div class="infoHourReserva">
                                                                        <?php
                                                                            if($productCartAtual["horaReserva"] != "00:00:00"){
                                                                            ?>
                                                                                <i class="fa-regular fa-clock"></i><span class="infoHourReserva"><?php echo $productCartAtual["horaReserva"]; ?></span>
                                                                            <?php
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                <?php  
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    endfor;
                                ?>
                            </div>
                        </div>

                        <div class="boxMethods">
                            <div class="boxMethods-header">
                                <div class="icon"><i class="fa-regular fa-credit-card"></i></div>
                                <span>Método de pagamento</span>
                            </div>

                            <div class="boxMethods-content">
                                <span><?php if($idPayment == "1"){ echo "<i class='fa-brands fa-pix'></i> pix"; }else if($idPayment == "2"){ echo "<i class='fa-solid fa-credit-card'></i> cartão"; } ?></span>
                            </div>
                        </div>
                    <?php
                }
            }
        }

        public function addOrder($idPayment, $idProduct, $dataReserva, $affiliate, $priceTotal){
            $conexao = $this->con;

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
            $hourReserva = 0;

            $dir = $_SERVER['DOCUMENT_ROOT'];
            include_once($dir."/components/config.php");
            require_once($dir.'/vendor/autoload.php');

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

                $queryConfig = $conexao->prepare("SELECT * FROM config_payment");
                $queryConfig->execute();

                if($queryConfig->rowCount() > 0){
                    $configPayment = $queryConfig->fetchAll(PDO::FETCH_ASSOC)[0];
                }

                $verify = (strpos($idProduct, "," ) !== false);
                 
                if ($verify){
                    $arrayProducts = explode(",", $idProduct);

                    $nameProduct = [];

                    for($p = 0; $p < sizeof($arrayProducts); $p++) {
                        $arrayAtual = $arrayProducts[$p];
    
                        $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                        $queryProduct->execute(array($arrayAtual));
            
                        if($queryProduct->rowCount()){
                            $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];
    
                            $queryCart = $conexao->prepare("SELECT * FROM cart WHERE idProduct = ? AND idUser = ?");
                            $queryCart->execute(array($productAtual["id"], $id));
    
                            if($queryCart->rowCount()){
                                $productCart = $queryCart->fetchAll(PDO::FETCH_ASSOC)[0];

                                if($productCart["type"] == "1"){
                                    $adultos = [];
                                    $criancasPagantes = [];
                                    $criancasNaoPagantes = [];

                                    $hourReserva = $productCart["horaReserva"];
                                    $adultos[] = $productCart["adultos"];
                                    $criancasPagantes[] = $productCart["criancasPagantes"];
                                    $criancasNaoPagantes[] = $productCart["criancasNaoPagantes"];
                                    $nameProduct[] = $productCart["name"];
                                }else if($productCart["type"] == "2"){
                                    if(!$hourReserva){
                                        $hourReserva = "00:00:00";
                                    }

                                    $nameProduct[] = $productAtual["name"];
                                }
                            }
                        }
                    }

                    $adultos = implode(",", $adultos);
                    $criancasPagantes = implode(",", $criancasPagantes);
                    $criancasNaoPagantes = implode(",", $criancasNaoPagantes);
                    $nameProduct = implode(",", $nameProduct);
                }else{
                    $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                    $queryProduct->execute(array($idProduct));
        
                    if($queryProduct->rowCount()){
                        $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];

                        $queryCart = $conexao->prepare("SELECT * FROM cart WHERE idProduct = ? AND idUser = ?");
                        $queryCart->execute(array($productAtual["id"], $id));

                        if($queryCart->rowCount()){
                            $productCart = $queryCart->fetchAll(PDO::FETCH_ASSOC)[0];

                            if($productAtual["type"] == "1"){
                                $hourReserva = $productCart["horaReserva"];
                                $adultos = $productCart["adultos"];
                                $criancasPagantes = $productCart["criancasPagantes"];
                                $criancasNaoPagantes = $productCart["criancasNaoPagantes"];
                                $nameProduct = $productCart["name"];
                            }else if($productAtual["type"] == "2"){
                                if($hourReserva == "" || $hourReserva == null || $hourReserva == "0"){
                                    $hourReserva = "00:00:00";
                                }

                                $nameProduct = $productAtual["name"];
                            }
                        }
                    }
                }

                if($affiliate != "0"){
                    $queryAffiliate = $conexao->prepare("SELECT * FROM affiliates WHERE cupomAffiliate = ?");
                    $queryAffiliate->execute(array($affiliate));

                    if($queryAffiliate->rowCount()){
                        $affiliateAtual = $queryAffiliate->fetchAll(PDO::FETCH_ASSOC)[0];

                        $priceTotal = $priceTotal-$affiliateAtual["priceDiscount"];
                    }
                }

                $query = $conexao->prepare("INSERT INTO orders (idUser, idProduct, methodPayment, data_reserva, hora_reserva, date_order, hour_order, date_update, adultos, criancasPagantes, criancasNaoPagantes, priceTotal, status, affiliate, ip, dispositive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if($query->execute(array($id, $idProduct, $idPayment, $dataReserva, $hourReserva, $data, $hour, $data.$hour, $adultos, $criancasPagantes, $criancasNaoPagantes, $priceTotal, 0, $affiliate, $ip, $dispositive))){
                    $queryOrder = $conexao->prepare("SELECT * FROM orders WHERE idUser = ? ORDER BY id DESC limit 1");

                    $queryDeleteCart = $conexao->prepare("DELETE FROM cart WHERE idUser = ?");
                    $queryDeleteCart->execute(array($id));
                    
                    if($queryOrder->execute(array($id))){
                        $orderAtual = $queryOrder->fetchAll(PDO::FETCH_ASSOC)[0];

                        if($idPayment == "1"){
                            if($configPayment["paymentPix"] != "0"){ 
                                include_once($dir."/components/payments/".$configPayment["paymentPix"].".php");
                            }
                        }else if($idPayment == "2"){
                            if($configPayment["paymentCard"] != "0"){
                                if($configPayment["paymentCard"] == "stripe"){
                                    $queryClient = $conexao->prepare("SELECT * FROM clients WHERE id = ?");
                                    $queryClient->execute(array($id));
                                    $client = $queryClient->fetchAll(PDO::FETCH_ASSOC)[0];
                                    $idClientStripe = $client["idClientStripe"];

                                    if($idClientStripe == 0){
                                        if($configPayment["developer"] == "0"){ $stripe_secrete_key = $configPayment["stripe_secret_key"]; }else{ $stripe_secrete_key =  $configPayment["stripe_secret_key_test"]; }

                                        $stripe = new \Stripe\StripeClient($stripe_secrete_key);
                                        $stripe->customers->create([
                                            'name' => $name." ".$lastname,
                                            'email' => $email,
                                            'phone' => $phone,
                                            'shipping' => [
                                                'name' => $name.$lastname,
                                                'phone' => $phone,
                                                'address' => [
                                                    'country' => $country,
                                                    'postal_code' => $cep
                                                ]
                                            ]
                                        ]);

                                        $customers = $stripe->customers->all(['limit' => 10])->data;

                                        for($e = 0; $e < sizeof($customers); $e++):
                                            $customer = $customers[$e]; 

                                            if($customer->email == $email){
                                                $idClientStripe = $customer->id;
                                                
                                                $queryUpdateUser = $conexao->prepare("UPDATE clients SET idClientStripe = ? WHERE id = ?");
                                                $queryUpdateUser->execute(array($idClientStripe, $id));
                                            }
                                        endfor;
                                    }
                                }

                                $location = $base_url."components/payments/".$configPayment['paymentCard'].".php"
                                ?>
                                    <script>
                                        window.location.href = "<?php echo $location; ?>";
                                    </script>
                                <?php
                            }
                        }
                    }
                }
            }
        }

        public function consultPaymentMP($idOrder){
            $conexao = $this->con;

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

                $queryConfig = $conexao->prepare("SELECT * FROM config_payment");
                $queryConfig->execute();

                if($queryConfig->rowCount() > 0){
                    $configPayment = $queryConfig->fetchAll(PDO::FETCH_ASSOC)[0];
                }

                $queryOrder = $conexao->prepare("SELECT * FROM orders WHERE id = ?");
                $queryOrder->execute(array($idOrder));

                if($queryOrder->rowCount()){
                    $orderAtual = $queryOrder->fetchAll(PDO::FETCH_ASSOC)[0];

                    $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                    $queryProduct->execute(array($orderAtual["idProduct"]));

                    if($queryProduct->rowCount()){
                        $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];
                    }

                    $ch = curl_init('https://api.mercadopago.com/v1/payments/'.$orderAtual["idOrderApi"]);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
                        'Content-Type: application/json',
                        'Authorization: Bearer '.$configPayment["access_token"],
                    ));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                    $response = curl_exec($ch);
        
                    curl_close($ch);
        
                    $result = json_decode($response);
                    $result1 = get_object_vars($result);
        
                    $statusOrder = $result1["status"];
                    $totalPrice = $result1["transaction_amount"];
        
                    $result2 = get_object_vars($result1["point_of_interaction"]);
                    $result3 = get_object_vars($result2["transaction_data"]);
        
                    $qrCodeBase64 = $result3["qr_code_base64"];
                    $qrCode = $result3["qr_code"];
                    $urlOrder = $result3["ticket_url"];

                    //$statusOrder = "approved";

                    if($statusOrder == "approved"){
                        $queryUpdate = $conexao->prepare("UPDATE orders SET status = ? WHERE id = ? AND idOrderApi = ?");
                        $queryUpdate->execute(array(1, $idOrder, $orderAtual["idOrderApi"]));

                        $idVoucher = substr(uniqid(), -6);

                        $queryVerify = $conexao->prepare("SELECT * FROM vouchers WHERE idVoucher = ?");
                        $queryVerify->execute(array($idVoucher));

                        if($queryVerify->rowCount() > 0){
                            $idVoucher = substr(uniqid(), -6);
                        }

                        $link = "idVoucher='".$idVoucher."'";
                        $linkVoucher = "https://qrcode.kaywa.com/img.php?s=100&d=".$link;

                        $queryVoucher = $conexao->prepare("INSERT INTO vouchers (idVoucher, idOrder, idUser, linkVoucher, date_created, date_update) VALUES (?, ?, ?, ?, ?, ?)");
                        if($queryVoucher->execute(array($idVoucher, $idOrder, $id, $linkVoucher, $data." ".$hour, $data." ".$hour))){
                            if($this->sendMailVoucher($idVoucher, $productAtual["name"], $orderAtual["data_reserva"], $orderAtual["hora_reserva"], $linkVoucher, $email, $name)){
                                
                            }
                        }

                        return json_encode(array("err" => 0, "message" => "approved"));
                    }else if($statusOrder == "pending"){
                        return json_encode(array("err" => 0, "message" => "pending"));
                    }
                }else{
                    return json_encode(array("err" => 1, "message" => "Pedido não encontrado!"));
                }
            }
        }

        public function redirectStripe($idPayment, $idOrder){
            $conexao = $this->con;

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

                $queryConfig = $conexao->prepare("SELECT * FROM config_payment");
                $queryConfig->execute();

                if($queryConfig->rowCount() > 0){
                    $configPayment = $queryConfig->fetchAll(PDO::FETCH_ASSOC)[0];
                }

                $queryOrder = $conexao->prepare("SELECT * FROM orders WHERE id = ?");
                $queryOrder->execute(array($idOrder));

                if($queryOrder->rowCount()){
                    $orderAtual = $queryOrder->fetchAll(PDO::FETCH_ASSOC)[0];

                    ?>
                        <script>window.location.href=<?php echo $orderAtual["link"]; ?></script>
                    <?php
                }
            }
        }

        public function createVoucher($idOrder){
            $conexao = $this->con;

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

                $queryConfig = $conexao->prepare("SELECT * FROM config_payment");
                $queryConfig->execute();

                if($queryConfig->rowCount() > 0){
                    $configPayment = $queryConfig->fetchAll(PDO::FETCH_ASSOC)[0];
                }

                $queryOrder = $conexao->prepare("SELECT * FROM orders WHERE id = ?");
                $queryOrder->execute(array($idOrder));

                if($queryOrder->rowCount()){
                    $orderAtual = $queryOrder->fetchAll(PDO::FETCH_ASSOC)[0];

                    $idVoucher = substr(uniqid(), -6);

                    $queryVerify = $conexao->prepare("SELECT * FROM vouchers WHERE idVoucher = ?");
                    $queryVerify->execute(array($idVoucher));

                    if($queryVerify->rowCount() > 0){
                        $idVoucher = substr(uniqid(), -6);
                    }

                    $link = "idVoucher='".$idVoucher."'";
                    $linkVoucher = "https://qrcode.kaywa.com/img.php?s=100&d=".$link;

                    $queryVoucher = $conexao->prepare("INSERT INTO vouchers (idVoucher, idOrder, idUser, linkVoucher, date_created, date_update) VALUES (?, ?, ?, ?, ?, ?)");
                    if($queryVoucher->execute(array($idVoucher, $idOrder, $id, $linkVoucher, $data." ".$hour, $data." ".$hour))){
                        if($this->sendMailVoucher($idVoucher, "Reserva", $orderAtual["data_reserva"], $orderAtual["hora_reserva"], $linkVoucher, $email, $name)){
                            
                        }
                    }
                }
            }
        }

        public function viewVoucher($idOrder){
            $conexao = $this->con;

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

                $query = $conexao->prepare("SELECT * FROM vouchers WHERE idOrder = ?");
                $query->execute(array($idOrder));

                if($query->rowCount()){
                    $voucher = $query->fetchAll(PDO::FETCH_ASSOC)[0];

                    $queryOrder = $conexao->prepare("SELECT * FROM orders WHERE id = ?");
                    $queryOrder->execute(array($idOrder));

                    if($queryOrder->rowCount()){
                        $order = $queryOrder->fetchAll(PDO::FETCH_ASSOC)[0];

                        $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                        $queryProduct->execute(array($order["idProduct"]));

                        $product = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];
                    }
                    ?>
                        <div class="modalVoucher">
                            <div class="modalVoucher-content">
                                <div class="modalVoucher-contentHeader">
                                <button class="btnCloseModalOrderSuccess">
                                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                                    <span>Voucher</span>
                                </button>
                                </div>

                                <div class="modalVoucher-contentBody">
                                    <div class="voucher">
                                        <div class="voucher-header">
                                            <img src="https://chamasbuzios.com.br/img/logo.png" alt="logo chamas buzios" />
                                        </div>

                                        <hr>

                                        <div class="voucher-body">
                                            <div class="box">
                                                <span class="idVoucher">ID: <?php echo $voucher["idVoucher"]; ?></span>
                                            </div>

                                            <div class="box">
                                                <span class="nameProduct"><?php echo $product["name"]; ?></span>
                                            </div>

                                            <div class="box">
                                                <span class="date">Data da reserva: <?php echo $order["data_reserva"]; ?></span>
                                            </div>

                                            <div class="box">
                                                <span class="hour">Hora da reserva: <?php echo $order["hora_reserva"]; ?></span>
                                            </div>

                                            <img class="qrVoucher" src="<?php echo $voucher["linkVoucher"]; ?>" alt="imagem do qr code voucher">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }
        }

        //PEDIDOS
        public function getOrders(){
            $conexao = $this->con;

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

                $queryOrders = $conexao->prepare("SELECT * FROM orders WHERE idUser = ?");
                $queryOrders->execute(array($id));

                if($queryOrders->rowCount()){
                    $orders = $queryOrders->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < count($orders); $i++){
                        $orderAtual = $orders[$i];

                        $dataReserva = new DateTime($orderAtual["data_reserva"]);
                        $dataReserva = $dataReserva->format("d/m/Y");

                        $totalVisitantes = $orderAtual["adultos"]+$orderAtual["criancasPagantes"]+$orderAtual["criancasNaoPagantes"];

                        $nameProduct = [];

                        $verify = (strpos($orderAtual["idProduct"], "," ) !== false);
                
                        if ($verify){
                            $arrayProducts = explode(",", $orderAtual["idProduct"]);

                            for($p = 0; $p < sizeof($arrayProducts); $p++) {
                                $arrayAtual = $arrayProducts[$p];
            
                                $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                                $queryProduct->execute(array($arrayAtual));
                    
                                if($queryProduct->rowCount()){
                                    $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];
            
                                    $nameProduct[] = $productAtual["name"];
                                }
                            }
                        }else{
                            $queryProduct = $conexao->prepare("SELECT * FROM products WHERE id = ?");
                            $queryProduct->execute(array($orderAtual["idProduct"]));
                
                            if($queryProduct->rowCount()){
                                $productAtual = $queryProduct->fetchAll(PDO::FETCH_ASSOC)[0];

                                $nameProduct[] = $productAtual["name"];
                            }
                        }

                        $nameProduct = implode(", ", $nameProduct);
                        
                        ?>
                            <div class="cardOrders">
                                <div class="cardOrders-header">
                                    <div class="nOrder">#<?php echo $orderAtual["id"]; ?></div>
                                </div>
                                <div class="cardOrders-content">
                                    <div class="box">
                                        <span class="nameProduct"><?php echo $nameProduct; ?></span>
                                    </div>

                                    <div class="box">
                                        <span class="dateReserva">Reservado para <span class="destaq"><?php echo $dataReserva ?></span> ás <span class="destaq"><?php echo $orderAtual["hora_reserva"]; ?></span></span>
                                    </div>

                                    <div class="box">
                                        <div class="icon"><i class="fa-solid fa-people-group"></i></div>
                                        <span class="totalVisitantes"><?php if($totalVisitantes > 1){ echo $totalVisitantes." pessoas"; }else{ echo $totalVisitantes." pessoa"; } ?></span>
                                    </div>

                                    <div class="box">
                                        <div class="icon"><?php if($orderAtual["methodPayment"] == "1"){ echo "<i class='fa-brands fa-pix'></i>"; }else if($orderAtual["methodPayment"] == "2"){ echo "<i class='fa-regular fa-credit-card'></i>"; } ?></div>
                                        <span class="priceTotal">R$<?php echo $orderAtual["priceTotal"]; ?></span>
                                    </div>

                                    <div class="box">
                                        <button class="btnViewMoreDetailsOrder" idOrder="<?php echo $orderAtual["id"]; ?>">Ver pedido</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
            }
        }

        public function getOrder($idOrder){
            $conexao = $this->con;
        }
    
        //PASSEIOS
        public function getPasseio($idProduct){
            $conexao = $this->con;

            date_default_timezone_set('America/Sao_Paulo');
            $timezone = new DateTimeZone('America/Sao_Paulo');
            $mysqldata  = new DateTime('now', $timezone);
            $data = $mysqldata->format("Y-m-d");

            $query = $conexao->prepare("SELECT * FROM products WHERE id = ?");
            $query->execute(array($idProduct));

            if($query->rowCount()){
                $passeio = $query->fetchAll(PDO::FETCH_ASSOC)[0];

                ?>
                    <div class="boxImage">
                        <div class="glide">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    <li class="glide__slide">
                                        <img class="slide" src="<?php echo $passeio["img"]; ?>" alt="">
                                    </li>
                                </ul>
                            </div>
            
                            <div class="glide__bullets" data-glide-el="controls[nav]">
                                <button class="glide__bullet" data-glide-dir="=0"></button>
                            </div>
                        </div>
                    </div>

                    <div class="boxInfo">
                        <div class="boxName">
                            <span class="title"><?php echo $passeio["name"]; ?></span>
                        </div>

                        <div class="division"></div>

                        <div class="boxDesc">
                            <span class="descProduct"><?php echo $passeio["description"] ?></span>
                        </div>

                        <div class="boxPrice">
                            <span class="price"><?php echo "R$".$passeio["pricePromo"]; ?> por pessoa</span>
                        </div>

                        <div class="boxDuration">
                            <?php
                                if($passeio["duration"] != "0"){
                                    ?>
                                        <span class="duration"><i class="fa-solid fa-clock" aria-hidden="true"></i><?php echo $passeio["duration"]; ?></span>
                                    <?php
                                }
                            ?>
                        </div>

                        <div id="boxReserva" class="boxReserva">
                            <div class="boxInfoPaxes">
                                <span class="infoMinPaxes"><?php if($passeio["minPaxes"] > "1"){ echo "Quantidade mínima: ".$passeio['minPaxes']." pessoas"; } ?></span>
                                <span class="infoPaxesMax"><?php if($passeio["maxPaxes"] > "0"){ echo "Quantidade máxima: ".$passeio['maxPaxes']." pessoas"; } ?></span>
                                <input type="hidden" id="minPaxes" value="<?php echo $passeio["minPaxes"]; ?>">
                                <input type="hidden" id="maxPaxes" value="<?php echo $passeio["maxPaxes"]; ?>">
                            </div>

                            <div class="division"></div>
                            
                            <span class="spanDataInput">Data de chegada</span>
                            <input type="date" name="dataInput" id="dataInput" idProduct="<?php echo $passeio["id"]; ?>" />

                            <div class="boxAlertDataInput"></div>

                            <!--<span class="spanDataOutput">Data de saída</span>
                            <input type="date" name="dataOutput" id="dataOutput_<?php //echo $passeio["id"]; ?>" disabled />-->

                            <div class="boxErr boxErrHoraReserva"></div>

                            <?php
                                $queryBookingTimeOptions = $conexao->prepare("SELECT * FROM booking_time_options WHERE idProduct = ?");
                                $queryBookingTimeOptions->execute(array($passeio["id"]));

                                if($queryBookingTimeOptions->rowCount()){
                                    $bookingTimeOptions = $queryBookingTimeOptions->fetchAll(PDO::FETCH_ASSOC);

                                    if(count($bookingTimeOptions) == 1){
                                        $bookingTimeOption = $bookingTimeOptions[0];

                                        if($bookingTimeOption["day"] == "every day"){

                                        }

                                        if(str_contains($bookingTimeOption["available_times"], "to") == true){
                                            $availableTimes = explode(" to ", $bookingTimeOption["available_times"]);

                                            $start = new \DateTime($availableTimes[0]);
                                            $times = 24 * 2; 
                                            $result[0] = $start->format('H:i');

                                            for ($i = 0; $i < $times - 1; $i++) {
                                                $newTimePrevist = new \DateTime($start->format('H:i'));
                                                $newTimePrevist->add(new DateInterval('PT'.$bookingTimeOption["intervals"].'M'));
                                                $newTimePrevist = $newTimePrevist->format('H:i');

                                                if($start->format('H:i') == $availableTimes[1] || $newTimePrevist > $availableTimes[1]){
                                                    break;
                                                }else{
                                                    $result[] = $start->add(new \DateInterval('PT'.$bookingTimeOption["intervals"].'M'))->format('H:i');
                                                }
                                            }

                                            ?>
                                                <select name="hourReservaPasseio" id="hourReservaPasseio">
                                                    <option value="0">Selecione um horário</option>
                                                    <?php
                                                        foreach($result as $time){
                                                            echo "<option value='".$time."'>".$time."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            <?php
                                        }else if(str_contains($bookingTimeOption["available_times"], ";") == true){
                                            $availableTimes = explode(";", $bookingTimeOption["available_times"]);

                                            ?>
                                                <div class="boxHorasReserva merriweather-regular">
                                                    <?php
                                                        foreach($availableTimes as $time){
                                                            if($time != ""){
                                                                ?>
                                                                    <div class="horaReserva" hora="<?php echo $time; ?>">
                                                                        <span><?php echo $time; ?></span>
                                                                    </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                            <?php
                                        }
                                    }
                                }
                            ?>   

                            <span class="spanVisitantes">Visitantes</span>
                            <button class="btnAlterVisitantes">1</button>

                            <div class="infoCriancas">
                                <span class="infoTextWarning">Sujeito a alteração por condições climáticas ou indisponibilidade</span>
                                <span>Crianças de 1 a 5 anos não paga</span>
                                <span>Crianças de 6 a 10 anos pagam meia</span>
                            </div>

                            <div class="infoPriceTotal">
                                <span id="viewPriceTotal">Total: R$<?php echo $passeio["pricePromo"]; ?></span>
                            </div>

                            <div class="division"></div>

                            <button class="btnBuyReserva" idPasseio=<?php echo $passeio["id"]; ?>  adultos="1" criancasPagantes="0" criancasNaoPagantes="0" priceTotal="<?php echo $passeio["pricePromo"]; ?>" nomePasseio="<?php echo $passeio["name"]; ?>" hourReserva="0">Adicionar ao carrinho</button>

                            <div class="modalAlterVisitantes">
                                <div class="modalAlterVisitantes-content">
                                <div class="modalAlterVisitantes-contentHeader">
                                    <span class="title">Escolha a quantidade de pessoas</span>
                                </div>

                                <div class="modalAlterVisitantes-contentBody">
                                    <div class="boxAdultos">
                                    <div class="left">
                                        <span class="spanQuantdAdultos">Adultos</span>
                                        <span class="subtitle">A partir de 11 anos</span>
                                    </div>

                                    <div class="middle">
                                        <span class="priceAdultos" price="<?php echo $passeio["pricePromo"]; ?>">R$<?php echo $passeio["pricePromo"]; ?></span>
                                    </div>

                                    <div class="right">
                                        <button class="subQuantdAdultos">-</button>
                                        <span class="quantdAdultos">1</span>
                                        <button class="somQuantdAdultos">+</button>
                                    </div>
                                    </div>

                                    <?php
                                    if($passeio["priceKids"] != "0"){
                                        ?>
                                        <div class="boxCriancas">
                                            <div class="left">
                                                <span class="spanQuantdCriancas">Crianças</span>
                                                <span class="subtitle">6 - 10 anos</span>
                                            </div>

                                            <div class="middle">
                                                <span class="priceCriancas" price="<?php echo $passeio["priceKids"]; ?>">R$<?php echo $passeio["priceKids"]; ?></span>
                                            </div>

                                            <div class="right">
                                                <button class="subQuantdCriancas">-</button>
                                                <span class="quantdCriancas">0</span>
                                                <button class="somQuantdCriancas">+</button>
                                            </div>
                                        </div>

                                        <div class="boxCriancasFree">
                                            <div class="left">
                                                <span class="spanQuantdCriancasFree">Bebê</span>
                                                <span class="subtitle">0 - 5 anos</span>
                                            </div>

                                            <div class="middle">
                                                <span class="priceCriancasFree" price="0,00">R$0,00</span>
                                            </div>

                                            <div class="right">
                                                <button class="subQuantdCriancasFree">-</button>
                                                <span class="quantdCriancasFree">0</span>
                                                <button class="somQuantdCriancasFree">+</button>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="modalAlterVisitantes-contentBottom">
                                    <button class="closeModalAlterVisitantes"><span>Fechar</span></button>
                                </div>
                                </div>
                            </div>

                            <?php
                                $queryTitleRoad = $conexao->prepare("SELECT title FROM roadMap WHERE title != ? AND idProduct = ?");
                                $queryTitleRoad->execute(array(0, $passeio["id"]));

                                if($queryTitleRoad->rowCount()){
                                    ?>
                                        <div class="boxRouter">
                                            <div class="boxRouter-header">
                                                <span class="title">Veja o roteiro:</span>
                                            </div>

                                            <div class="boxRouter-content">
                                                <?php
                                                    $titleRoad = $queryTitleRoad->fetchAll(PDO::FETCH_ASSOC)[0];

                                                    ?>
                                                        <span class="title"><?php echo $titleRoad["title"]; ?></span>
                                                    <?php

                                                    $queryRoad = $conexao->prepare("SELECT * FROM roadMap WHERE text != ? AND idProduct = ?");
                                                    $queryRoad->execute(array(0, $passeio["id"]));

                                                    if($queryRoad->rowCount()){
                                                        $roads = $queryRoad->fetchAll(PDO::FETCH_ASSOC);

                                                        for($r = 0; $r < sizeof($roads); $r++) {
                                                            $roadAtual = $roads[$r];

                                                            ?>
                                                                <div class="etap">
                                                                    <div class="icon">
                                                                        <?php 
                                                                            $tam = strlen($roadAtual["sequence"]); 
                                                                            if($tam == "1"){
                                                                                echo "<i class='fa-solid fa-".$roadAtual["sequence"]."'></i>";
                                                                            }else if($tam == "2"){
                                                                                $arr1 = str_split($roadAtual["sequence"]);
                                                                                ?>
                                                                                    <div class="boxIcon">
                                                                                        <i class='fa-solid fa-<?php echo $arr1[0]; ?>'></i>
                                                                                        <i class='fa-solid fa-<?php echo $arr1[1]; ?>'></i>
                                                                                    </div>
                                                                                <?php
                                                                            }
                                                                        
                                                                            if($r+1 < sizeof($roads)){
                                                                                ?>
                                                                                    <div class="lineRouter"></div>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                    <span><?php echo $roadAtual["text"]; ?></span>
                                                                </div>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>

                            <?php
                                $queryIncluded = $conexao->prepare("SELECT * FROM included WHERE idProduct = ?");
                                $queryIncluded->execute(array($passeio["id"]));

                                if($queryIncluded->rowCount()){
                                    ?>
                                        <div class="division"></div>

                                        <div class="boxMoreInfos">
                                            <div class="boxMoreInfos-header">
                                                <span class="title">O que está incluso:</span>
                                            </div>

                                            <div class="boxMoreInfos-content">
                                                <?php
                                                    $includs = $queryIncluded->fetchAll(PDO::FETCH_ASSOC);

                                                    for($i = 0; $i < sizeof($includs); $i++) {
                                                        $includAtual = $includs[$i];

                                                        ?>
                                                            <div class="box">
                                                                <span><?php echo $includAtual["text"]; ?></span>
                                                            </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>

                            <?php
                                $queryRecommendations = $conexao->prepare("SELECT * FROM recommendations WHERE idProduct = ?");
                                $queryRecommendations->execute(array($passeio["id"]));

                                if($queryRecommendations->rowCount()){
                                    ?>
                                        <div class="division"></div>

                                        <div class="boxRecommendations">
                                            <div class="boxRecommendations-header">
                                                <span class="title">Recomendações: </span>
                                            </div>

                                            <div class="boxRecommendations-content">
                                                <?php
                                                    $recommendations = $queryRecommendations->fetchAll(PDO::FETCH_ASSOC);

                                                    for($i = 0; $i < sizeof($recommendations); $i++) {
                                                        $recommendatioAtual = $recommendations[$i];

                                                        ?>
                                                            <div class="box">
                                                                <span><?php echo $recommendatioAtual["text"]; ?></span>
                                                            </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>

                    <input id="dataHoje" type="text" data="<?php echo $data; ?>" disabled>
                <?php
            }
        }
    }

    $conexao = new Conexao();
    $classe = new Actions($conexao->conectar());
    $classe->send();
?>