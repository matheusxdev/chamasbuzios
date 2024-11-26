$(document).on("click", ".btnLogin", function(){
  if($(".modalLogin").is(".active")){
    $(".modalLogin").removeClass("active");
    $("body").removeClass("desactive");
  }else{
    $(".modalLogin").addClass("active");
    $("body").addClass("desactive");
  }
});

$(document).on("click", ".btnCloseModalLogin", function(){
  $(".modalLogin").removeClass("active");
  $("body").removeClass("desactive");
});

$(document).on("click", ".modalLogin .btnShowPassword", function(){
  $(this).addClass("btnHidePassword");
  $(".modalLogin .btnHidePassword").removeClass("btnShowPassword");
  $(".modalLogin .btnHidePassword").html('<i class="fa-regular fa-eye-slash"></i>');

  $(".modalLogin #inputPassLogin").attr("type", "text");
});

$(document).on("click", ".modalLogin .btnHidePassword", function(){
  $(this).addClass("btnShowPassword");
  $(".modalLogin .btnShowPassword").removeClass("btnHidePassword");
  $(".modalLogin .btnShowPassword").html('<i class="fa-regular fa-eye"></i>');

  $(".modalLogin #inputPassLogin").attr("type", "password");
});

$(document).on("click", ".modalCad .btnShowPassword", function(){
  $(this).addClass("btnHidePassword");
  $(".modalCad .btnHidePassword").removeClass("btnShowPassword");
  $(".modalCad .btnHidePassword").html('<i class="fa-regular fa-eye-slash"></i>');

  $(".modalCad #inputPassCad").attr("type", "text");
});

$(document).on("click", ".modalCad .btnHidePassword", function(){
  $(this).addClass("btnShowPassword");
  $(".modalCad .btnShowPassword").removeClass("btnHidePassword");
  $(".modalCad .btnShowPassword").html('<i class="fa-regular fa-eye"></i>');

  $(".modalCad #inputPassCad").attr("type", "password");
});

$(document).on("click", ".btnLogar", function(){
  var email = $(".modalLogin-content #inputEmailLogin").val();
  var pass = $(".modalLogin-content #inputPassLogin").val();

  $.ajax({
      url: "../actions/actions.php",
      type: "POST",
      data: {
          type: "loginClient",
          email: email,
          pass: pass
      },

      beforeSend : function(){
          $(".btnLogar").addClass("loading");
          $(".btnLogar").html('<div class="loader"></div>');
      },

      success: function(result){
          result = JSON.parse(result);
                      
          if(result["err"] == "0"){
              $(".alert").addClass("active success");
              $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');

              setTimeout(function(){
                  $(".alert").removeClass("active success");
                  $(".alert").html('');

                  var locationAtual = window.location.href;
                  window.location.href=locationAtual;
              }, 2000);
          }else if(result["err"] == "1"){
              $(".alert").addClass("active err");
              $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');

              setTimeout(function(){
                  $(".alert").removeClass("active err");
                  $(".alert").html('');
              }, 2000);
          }
      },

      error: function(){
          $(".alert").addClass("active err");
          $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Ocorreu um erro, contacte o suporte</span>');

          setTimeout(function(){
              $(".alert").removeClass("active err");
              $(".alert").html('');
          }, 2000);
      }
  });
});

$(document).on("click", ".btnChangeCad", function(){
  $(".modalLogin").removeClass("active");
  $(".modalCad").addClass("active");
});

$(document).on("click", ".btnChangeLogin", function(){
  $(".modalCad").removeClass("active");
  $(".modalLogin").addClass("active");
});

$(document).on("click", ".btnCloseModalCad", function(){
  $(".modalCad").removeClass("active");
  $("body").removeClass("desactive");
});

$(document).on("click", ".btnCad", function(){
  var name = $(".modalCad-content #inputNameCad").val();
  var lastname = $(".modalCad-content #inputLastNameCad").val();
  var country = $(".country .custom-select .select-selected").attr("country");
  var cpf = 0;
  var cep = 0;
  var email = $(".modalCad-content #inputEmailCad").val();
  var phone = $(".modalCad-content #inputPhone").val();
  var pass = $(".modalCad-content #inputPassCad").val();

  if(country == "br"){
      cpf = $(".modalCad-content #inputCpf").val();
      cep = $(".modalCad-content #inputCep").val();
  }else{
      cpf = 0;
      cep = 0;
  }

  if(name == "" || lastname == "" || country == "" || email == "" || phone == "" || pass == ""){
      $(".alert").addClass("active err");
      $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Preencha todos os campos</span>');

      setTimeout(function(){
          $(".alert").removeClass("active err");
          $(".alert").html('');
      }, 2000);
  }else{
    $.ajax({
        url: "../actions/actions.php",
        type: "POST",
        data: {
            type: "cadClient",
            name: name,
            lastname: lastname,
            country: country,
            cpf: cpf,
            cep: cep,
            email: email,
            phone: phone,
            pass: pass
        },
  
        beforeSend : function(){
            $(".btnCad").addClass("loading");
            $(".btnCad").html('<div class="loader"></div>');
        },
  
        success: function(result){
            result = JSON.parse(result);
                        
            if(result["err"] == "0"){
                $(".alert").addClass("active success");
                $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');
  
                setTimeout(function(){
                    $(".alert").removeClass("active success");
                    $(".alert").html('');
  
                    window.location.href='/';
                }, 2000);
            }else if(result["err"] == "1"){
                $(".alert").addClass("active err");
                $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');
  
                setTimeout(function(){
                    $(".alert").removeClass("active err");
                    $(".alert").html('');

                    $(".btnCad").removeClass("loading");
                    $(".btnCad").html('Cadastrar');
                }, 2000);
            }
        },
  
        error: function(){
            $(".alert").addClass("active err");
            $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Ocorreu um erro, contacte o suporte</span>');
  
            setTimeout(function(){
                $(".alert").removeClass("active err");
                $(".alert").html('');
            }, 2000);
        }
    });
  }
});

$(document).on("click", ".btnLogout", function(){
  $.ajax({
      url:'../actions/actions.php',
      type: "POST",
      data: {
           type: "logout"
      },
      
      success: function(result){
          if(result["err"] == "0"){
              $(".alert").addClass("active err");
              $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');
          }else{
              setTimeout(function(){
                  window.location = '/';
              }, 500);
          }
       }
   });
});

//COUNTRIES
$(document).on('click', ".country .custom-select .select-selected", function(){
    if($(".country .custom-select .select-items").is(".active")){
      $(".country .custom-select .select-items").removeClass("active");
      return;
    }

    $(".country .custom-select .select-items").addClass("active");
});

$(document).on('click', '.country .custom-select .select-items > div', function(e){
    e.preventDefault();

    country = $(this).attr("data-value");
    $(".country .custom-select .select-selected").html($(this).html());
    $(".country .custom-select .select-selected").attr("country", country);
    $(".country .custom-select .select-items").removeClass("active");

    if(country == "br"){
        $(".modalCad-content .boxInfoBr").addClass("active");
        $(".modalCad-content #inputCpf").attr("required", true);
    }else{
        $(".modalCad-content .boxInfoBr").removeClass("active");
        $(".modalCad-content #inputCpf").attr("required", false);
    }
});

//VALIDATE CPF
$(document).on("input", '#inputCpf', function() {
    $(this).val(this.value.replace(/\D/g, ''));
});

$(document).on("input", '#inputCep', function() {
    $(this).val(this.value.replace(/\D/g, ''));
});