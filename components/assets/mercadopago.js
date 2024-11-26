function copyQrCode() {
  var copyText = document.getElementById("copyCodeQrOrder");

  copyText.select();
  copyText.setSelectionRange(0, 99999);

  navigator.clipboard.writeText(copyText.value);
}

$(document).on("click", ".copyQrCodeOrder", function(){
  copyQrCode();

  $(".alert").addClass("active success");
  $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Código copiado com sucesso!</span>');

  setTimeout(function(){
      $(".alert").removeClass("active success");
      $(".alert").html('');
  }, 1000);
});

$(document).on("click", ".btnConfirmPayment", function(){
  var idOrder = $(this).attr("idOrder");

  consultPayment(idOrder);
});

function consultPayment(idOrder){
    $.ajax({
        url:'../actions/actions.php',
        type: "POST",
        data: {
              type: "consultPaymentMP",
      
              idOrder: idOrder,
          },

          beforeSend : function(){
            $(".btnConfirmPayment").addClass("loading");
            $(".btnConfirmPayment").html('<div class="loader"></div>');
            $(".btnConfirmPayment").attr("disabled", true);
        },
        
        success: function(data){
          result = JSON.parse(data);

          if(result["err"] == "0"){
            if(result["message"] == "approved"){

                $(".alert").addClass("success active");
                $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Pagamento aprovado</span>');

                setTimeout(function(){
                    $(".alert").removeClass("active success");
                    $(".alert").html('');
                }, 2000);

                $(".boxSuccess span.title").html("Parabéns, seu voucher já está disponível!");
                $(".boxSuccess span.info").html("Você pode vizualizar o seu voucher clicando no botão abaixo ou pelo e-mail que enviamos para você.");
                $(".boxSuccess span.nOrder").remove();
                $(".boxSuccess img.imgQrOrder").remove();
                $(".boxSuccess div.copyCodeQrOrder").remove();
                $(".boxSuccess span.priceOrder").remove();
                $(".boxSuccess button.btnConfirmPayment").remove();
                $(".boxSuccess div.barProgress").remove();
                $(".boxSuccess").append('<button class="btnViewVoucher" idOrder="'+idOrder+'">Ver voucher</button>');

            }else if(result["message"] == "pending"){
              $(".alert").addClass("err active");
              $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Pagamento ainda não aprovado</span>');

              setTimeout(function(){
                  $(".alert").removeClass("active err");
                  $(".alert").html('');
              }, 2000);
            }
          }else{
            $(".alert").addClass("err active");
            $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');

            setTimeout(function(){
                $(".alert").removeClass("active err");
                $(".alert").html('');
            }, 2000);
          }
          }
      });
}

$(document).on("click", ".btnViewVoucher", function(){
  var idOrder = $(this).attr("idOrder");
  
  $.ajax({
    url:'../actions/actions.php',
    type: "POST",
    data: {
          type: "viewVoucher",
          idOrder: idOrder,
      },

      beforeSend : function(){
        $(".btnViewVoucher").addClass("loading");
        $(".btnViewVoucher").html('<div class="loader"></div>');
        $(".btnViewVoucher").attr("disabled", true);
      },
    
    success: function(data){
      if(data != ""){
        $(".modalOrderSuccess-content").html(data);
        $(".modalVoucher").addClass("active");
      }else{
        $(".alert").addClass("err active");
        $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Ocorreu um erro, contacte o suporte</span>');

        setTimeout(function(){
            $(".alert").removeClass("active err");
            $(".alert").html('');
        }, 2000);
      }
    }
  });
});