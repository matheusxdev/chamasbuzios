$(document).on("click", ".btnCloseModalCart", function(){
  $(".modalCart").removeClass("active");
  $("body").removeClass("desactive");
});

$(document).on("click", ".alterSubQuantdProduct", function(){
  var idProduct = $(this).attr("idProduct");
  var quantd = $("#spanQuantdProduct_"+idProduct).html();
  var newQuantd = parseInt(quantd)-parseInt(1);

  $.ajax({
      url: "../actions/actions.php",
      type: "POST",
      data: {
          type: "updateCart",
          idProduct: idProduct,
          quantd: newQuantd
      },

      beforeSend : function(){
          
      },

      success: function(result){
          if(result == "delete"){
              getCart();
          }else if(result != ""){
              getCart();
          }
      },

      error: function(){
          
      }
  });
});

$(document).on("click", ".alterSomQuantdProduct", function(){
  var idProduct = $(this).attr("idProduct");

  var quantd = $("#spanQuantdProduct_"+idProduct).html();
  var newQuantd = parseInt(quantd)+parseInt(1);

  $.ajax({
      url: "../actions/actions.php",
      type: "POST",
      data: {
          type: "updateCart",
          idProduct: idProduct,
          quantd: newQuantd
      },

      beforeSend : function(){
          
      },

      success: function(result){
          if(result == "delete"){
              getCart();
          }else if(result != "0"){
              getCart();
          }
      },

      error: function(){
          
      }
  });
});

$(document).on("click", ".deleteProductCart", function(){
  var idProduct = $(this).attr("idProduct");
  var newQuantd = 0;

  $.ajax({
      url: "../actions/actions.php",
      type: "POST",
      data: {
          type: "updateCart",
          idProduct: idProduct,
          quantd: newQuantd
      },

      beforeSend : function(){
          $(".deleteCart").html('<div class="loader"></div>')
      },

      success: function(result){
          if(result == "delete"){
              getCart();
          }else if(result != "0"){
              getCart();
          }
      },

      error: function(){
          
      }
  });
});

$(document).on("click", ".continueCart", function(){
    var dataReserva = $(this).attr("dataReserva");
    var affiliate = localStorage.getItem('affiliate');
            
    if(affiliate){
        $('.continueOrder').attr("affiliate", affiliate);

        if(affiliate == "0"){
            $("#inputCupomAffiliate").val("");
        }else{
            $("#inputCupomAffiliate").val(affiliate);
        }
    }

    if($(".boxReservarBottom").is(".active")){
        var dataReserva = $("#inputReservaBottom").val();

        if(dataReserva == "undefined"){
            $(".alert").addClass("active err");
            $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Escolha a data da reserva</span>');
    
            setTimeout(function(){
                $(".alert").removeClass("active err");
                $(".alert").html("");
            }, 2000);
        }else if(dataReserva != ""){
            $(".methodsPayment").addClass("active");
            $(".continueOrder").attr("dataReserva", dataReserva);
            /*$(".feed").addClass("desactive");
            $(".modalCart-content").addClass("desactive");*/
        }else{
            $(".alert").addClass("active err");
            $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Escolha a data da reserva</span>');
    
            setTimeout(function(){
                $(".alert").removeClass("active err");
                $(".alert").html("");
            }, 2000);
        }
    }else{
        $(".methodsPayment").addClass("active");
        $(".continueOrder").attr("dataReserva", dataReserva);
    }
});

$(document).on("click", ".btnCloseModalMethodsPayment", function(){
    $(".methodsPayment").removeClass("active");
});

$(document).on("click", ".methodsPayment .boxPayment", function(){
    $(".methodsPayment .boxPayment").removeClass("active");
    $(this).addClass("active");
    var idPayment = $(this).attr("payment");
    $(".continueOrder").attr("idPayment", idPayment);

    $.ajax({
        url:'actions/actions.php',
        type: "POST",
        data: {
            type: "confirmOrder",
            idPayment: idPayment
        },

        beforeSend : function(){
            
        },
        
        success: function(result){
            if(result != ""){
                $(".modalConfirmOrder").addClass("active");
                $(".modalConfirmOrder-contentBody").html(result);
            }else{
                $(".alert").addClass("active err");
                $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');

                setTimeout(function(){
                    $(".alert").removeClass("active err");
                    $(".alert").html('');
                }, 1000);
            }
        }
    });
});

$(document).on("click", ".btnCloseModalConfirmOrder", function(){
    $(".modalConfirmOrder").removeClass("active");
});

$(document).on("click", ".continueOrder", function(){
    /* FINALIZAR */
    var idPayment = $(this).attr("idPayment");
    var idProduct = $(this).attr("idProduct");
    var dataReserva = $(this).attr("dataReserva");
    var affiliate = $(this).attr("affiliate");
    var priceTotal = $(this).attr("priceTotal");

    if(idPayment == null){
        $(".boxErrPayment").addClass("active");
        $(".boxErrPayment").html("Selecione um método de pagamento");

        setTimeout(function(){
            $(".boxErrPayment").removeClass("active");
        }, 2000);
    }else {
        $.ajax({
            url:'actions/actions.php',
            type: "POST",
            data: {
                 type: "addOrder",
                 idPayment: idPayment,
                 idProduct: idProduct,
                 dataReserva: dataReserva,
                 affiliate: affiliate,
                 priceTotal: priceTotal
             },

             beforeSend : function(){
                $(".continueOrder").addClass("loading");
                $(".continueOrder").html("<div class='loader'></div>");
                $(".continueOrder").addClass("disabled");
            },
            
            success: function(data){
                if(data != ""){
                    setTimeout(function(){
                        //window.location.href = '/order-success?idOrder='+data;
                        $(".modalOrderSuccess").addClass("active");
                        $(".modalOrderSuccess-contentBody").html(data);

                        setTimeout(function(){
                            $(".orderSpinner").addClass("success");
                            $(".orderSpinner").html('<i class="fa-solid fa-check"></i>');
                        }, 2000);

                        localStorage.setItem('affiliate', "0");
                    }, 2000);
                }
             }
         });
    }
});

//ALTERAR 

$(document).on("change", "#inputReservaBottom", function(){
    var dataReserva = $(this).val();

    if(dataReserva != ""){
        $(".spanDateReservaBottom").html("Reservado para: "+dataReserva);
        $(".modalReservaBottom ").removeClass("active");
        $(".continueOrder").attr("dataReserva", dataReserva);
    }
});

$(document).on("click", ".closeModalInfoPayer", function(){
    $(".modalInfoPayer").removeClass("active");
    $(".feed").removeClass("desactive");
    $(".modalCart-content").removeClass("desactive");
});

nacionalidade = 0;
$(document).on("change", ".modalInfoPayer-content #inputNacionalidade", function(){
    nacionalidade = $(this).val();

    if(nacionalidade == "br"){
        $(".boxCpf").addClass("active");
        $(".boxCep").addClass("active");
    }else if(nacionalidade == "estrangeiro"){
        $(".boxCpf").removeClass("active");
        $(".boxCep").removeClass("active");
    }

    $(".continueOrder").attr("nacionalidade", nacionalidade);
});

$(document).on("change", ".modalCad-content #inputNacionalidade", function(){
    nacionalidade = $(this).val();

    if(nacionalidade == "br"){
        $(".boxInfoBr").addClass("active");
    }else if(nacionalidade == "ex"){
        $(".boxInfoBr").removeClass("active");
    }

    $(".btnCad").attr("nacionalidade", nacionalidade);
});

/*var temporiza;
$(document).on("input", "#inputCpf", function(e){
    var cpf = $(this).val();

    clearTimeout(cpfTotal);
    var cpfTotal = setTimeout(function(){
        if(cpf.length == "3"){
            clearTimeout(alterCpf);
            var alterCpf = setTimeout(function(){
                $("#inputCpf").val("");
                $("#inputCpf").val(cpf+".");
            }, 10);
        }else if(cpf.length == "7"){
            var alterCpf = setTimeout(function(){
                var cpf = $("#inputCpf").val();
                $("#inputCpf").val("");
                $("#inputCpf").val(cpf+".");
            }, 10);
        }else if(cpf.length == "11"){
            var alterCpf = setTimeout(function(){
                var cpf = $("#inputCpf").val();
                $("#inputCpf").val("");
                $("#inputCpf").val(cpf+"-");
            }, 10);
        }
    
        var limite = "14";
    
        clearTimeout(limiteInput);
        var limiteInput = setTimeout(function(){
            if(cpf.length > limite) {
                $("#inputCpf").val(cpf.substr(0, limite));
            }
        },10);
    }, 100);
});*/

var temporiza;
$(document).on("input", "#inputPhone", function(e){
    var contact = $(this).val();

    clearTimeout(contactTotal);
    var contactTotal = setTimeout(function(){
        if(contact.length == "1"){
            clearTimeout(alterContact);
            var alterContact = setTimeout(function(){
                var contact = $("#inputPhone").val();
                $("#inputPhone").val("");
                $("#inputPhone").val("("+contact);
            }, 10);
        }else if(contact.length == "3"){
            clearTimeout(alterContact);
            var alterContact = setTimeout(function(){
                var contact = $("#inputPhone").val();
                $("#inputPhone").val("");
                $("#inputPhone").val(contact+")");
            }, 10); 
        }else if(contact.length == "9"){
            clearTimeout(alterContact);
            var alterContact = setTimeout(function(){
                var contact = $("#inputPhone").val();
                $("#inputPhone").val("");
                $("#inputPhone").val(contact+"-");
            }, 10);
        }
    
        var limite = "14";
    
        clearTimeout(limiteInput);
        var limiteInput = setTimeout(function(){
            if(contact.length > limite) {
                $("#inputPhone").val(contact.substr(0, limite));
            }
        }, 10);
    }, 100);
});

var temporiza;
$(document).on("input", "#inputCep", function(){
    var cep = $(this).val().replace(/\D/g, '');
    $("#inputCep").removeClass("err");

    if(cep != ""){
        if(cep.length == "5"){
            $("#inputCep").val(cep+"-");
        }

        var validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)) {
            $(".changeCep").addClass("active");
            $("#inputAddress").val("...");
            $("#inputCity").val("...");
            $("#inputState").val("...");
        
            $("#inputAddress").attr("disabled", "true");
            $("#inputCity").attr("disabled", "true");
            $("#inputState").attr("disabled", "true");
    
            clearTimeout(temporiza);
            temporiza = setTimeout(function(){
                $.ajax({
                    url: "../actions/actions.php",
                    type: "POST",
                    data: {
                        type: "getCep",
                        cep: cep
                    },
        
                    beforeSend : function(){
                        
                    },
        
                    success: function(result){
                        if(result != ""){
                            $(".changeCep").html(result);
                            $("#inputAddress").removeAttr("disabled", "true");
                            $("#inputCity").removeAttr("disabled", "true");
                            $("#inputState").removeAttr("disabled", "true");
                            $("#inputCep").removeClass("err");
                        }else{
                            $("#inputAddress").removeAttr("disabled", "true");
                            $("#inputCity").removeAttr("disabled", "true");
                            $("#inputState").removeAttr("disabled", "true");

                            $("#inputCep").addClass("err");

                            $(".alert").addClass("err active");
                            $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>CEP não encontrado</span>');

                            setTimeout(function(){
                                $(".alert").removeClass("err active");
                                $(".alert").html("");
                            }), 1000;
                        }
                    },
        
                    error: function(){
                        $(".alert").addClass("active err");
                        $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Ocorreu um erro, tente novamente</span>');
        
                        setTimeout(function(){
                            $(".alert").removeClass("active success");
                            $(".alert").html('');
                        }, 2000);
        
                        $("#inputAddress").removeAttr("disabled", "true");
                        $("#inputCity").removeAttr("disabled", "true");
                        $("#inputState").removeAttr("disabled", "true");
                    }
                });
            }, 2000);
        }else{
            $("#cep").addClass("err");
        }
    }else{
        $("#cep").addClass("err");
        $(".alert").addClass("err active");
        $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>CEP inválido</span>');

        setTimeout(function(){
            $(".alert").removeClass("err active");
            $(".alert").html("");
        }, 1000);
    }
});