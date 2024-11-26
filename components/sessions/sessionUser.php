<?php
  require_once("./actions/conexao.php");

  $conexaoClass = new Conexao();
  $conexao = $conexaoClass->conectar();

  session_set_cookie_params(PHP_INT_MAX);
  session_start();

  if(isset($_SESSION["user"]) && is_array($_SESSION["user"])){
      $id = $_SESSION["user"][0];
      $name = $_SESSION["user"][1];
      $lastname = $_SESSION["user"][2];
      $nacionalidade = $_SESSION["user"][3];
      $cpf = $_SESSION["user"][4];
      $cep = $_SESSION["user"][5];
      $email = $_SESSION["user"][6];
      $phone = $_SESSION["user"][7];
      $ip = $_SESSION["user"][8];
      $dispositive = $_SESSION["user"][9];
      $data = $_SESSION["user"][10];
  }else if(isset($_SESSION["userClient"]) && is_array($_SESSION["userClient"])){
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
  }
?>