<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/modalLogin.css?v=<?php echo time(); ?>">
</head>

<div class="modalLogin">
  <div class="modalLogin-content">
    <div class="modalLogin-contentHeader">
        <button class="btnCloseModalLogin"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="modalLogin-contentBody">
        <img src="img/logo.png" alt="">
        <span class="title">Bem vindo de volta</span>

        <div class="box boxEmail">
            <label for="inputEmailLogin">Email</label>
            <input type="text" id="inputEmailLogin" />
        </div>

        <div class="box boxPass">
            <label for="inputPassLogin">Senha</label>
            <input type="password" id="inputPassLogin" />
            <button class="btnShowPassword"><i class="fa-regular fa-eye"></i></button>
        </div>

        <button class="btnLogar">Entrar</button>
        <button class="btnChangeCad">Não possui uma conta ainda? Clique aqui</button>
    </div>
  </div>
</div>

<div class="modalCad">
  <div class="modalCad-content">
    <div class="modalCad-contentHeader">
        <button class="btnCloseModalCad"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="modalCad-contentBody">
        <span class="title">Cadastrar</span>

        <div class="box boxName">
            <label for="inputNameCad">Nome</label>
            <input type="text" id="inputNameCad" />
        </div>

        <div class="box boxLastName">
            <label for="inputLastNameCad">Sobrenome</label>
            <input type="text" id="inputLastNameCad" />
        </div>

        <div class="box">
            <label for="inputNacionalidade">Nacionalidade</label>
            <?php include_once($dir."/components/modalLogin/country.php"); ?>
        </div>

        <div class="boxInfoBr">
            <div class="box boxCpf">
                <label for="inputCpf">CPF</label>
                <input type="text" id="inputCpf" maxlength="11" minlength="11" />
            </div>

            <div class="box boxCep">
                <label for="inputCpf">CEP</label>
                <input type="text" id="inputCep" maxlength="8" minlength="8" />
            </div>
        </div>

        <div class="box boxEmail">
            <label for="inputEmailCad">Email</label>
            <input type="text" id="inputEmailCad" />
        </div>

        <div class="box boxPhone">
            <label for="inputPhone">Celular</label>
            <input type="text" id="inputPhone">
        </div>

        <div class="box boxPass">
            <label for="inputPassCad">Senha</label>
            <input type="password" id="inputPassCad" />
            <button class="btnShowPassword"><i class="fa-regular fa-eye"></i></button>
        </div>

        <button class="btnCad">Cadastrar</button>
        <button class="btnChangeLogin">Já possui conta? Clique aqui</button>
    </div>
  </div>
</div>