<?php
    require("conexao.php");
    $conexaoClass = new Conexao();
    $conexao = $conexaoClass->conectar();

    session_set_cookie_params(PHP_INT_MAX);
    session_start();
    if(isset($_SESSION["user"]) && is_array($_SESSION["user"])){
        $id = $_SESSION["user"][0];
        $nome = $_SESSION["user"][1];
        $img = $_SESSION["user"][2];
        $user = $_SESSION["user"][3];
        $bio = $_SESSION["user"][4];
    }

    $img = filter_input(INPUT_POST, 'img', FILTER_DEFAULT);
    
    list($type, $img) = explode(';', $img);
    list(, $img) = explode(',', $img);

    $img = base64_decode($img);

    if($type == "data:video/mp4"){
        $photoName = time() . '.mp4';
        $verifyType = "video";
    }else{
        $photoName = time() . '.webp';
        $verifyType = "image";
    }
    
    $folder = "https://chamasbuzios.com.br/public/uploads/";
    $path = $folder.$photoName;

    date_default_timezone_set('America/Sao_Paulo');
    $timezone = new DateTimeZone('America/Sao_Paulo');
    $mysqldata  = new DateTime('now', $timezone);
    $data = $mysqldata->format("Y-m-d H:i:s");

    if(file_put_contents('../public/uploads/' . $photoName, $img)){
        if($verifyType == "video"){
            
        }else{
            $query = $conexao->prepare("INSERT INTO cardapio (img, nome, description, category, priceAnt, pricePromo, priceKids, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $query->execute(array($path, 0, 0, 0, 0, 0, 0, $data));

            $queryProducts = $conexao->prepare("SELECT MAX(id) as id FROM cardapio");
            $queryProducts->execute();

            $product = $queryProducts->fetchAll(PDO::FETCH_ASSOC)[0];

            echo $product["id"];   
        }
    }else{
        echo "err";
    }
?>