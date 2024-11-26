function getPasseio(idProduct){
  $.ajax({
      url:'actions/actions.php',
      type: "POST",
      data: {
              type: "getPasseio",
              idProduct: idProduct,
          },

      beforeSend : function(){
          $("#addCart_"+idProduct).html('<div class="loader"></div>');
          $("#addCart_"+idProduct).addClass("loading");
      },
      
      success: function(data){
          if(data != ""){
              $("body").addClass("desactive");
              $("#addCart_"+idProduct).html('<i class="fa-solid fa-cart-plus"></i>');
              $("#addCart_"+idProduct).removeClass("loading");
              $(".modalPasseio").addClass("active");
              $(".modalPasseio-content").html(data);

              window.history.pushState("", "Destino Tour Búzios", '/?passeio='+idProduct);

              var glide = new Glide('.glide', {
                                  
              });
      
              glide.mount();
          }else{
              $("#addCart_"+idProduct).html('<i class="fa-solid fa-cart-plus"></i>');
              $("#addCart_"+idProduct).removeClass("loading");
              
              $(".alert").addClass("active err");
              $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Ocorreu um erro</span>');

              setTimeout(function(){
                  $(".alert").removeClass("active err");
                  $(".alert").html("");
              }, 2000);
          }
      }
  });
}

function getNCart(){
  $.ajax({
      url: "../actions/actions.php",
      type: "POST",
      data: {
          type: "getNCart"
      },

      beforeSend : function(){
          
      },

      success: function(result){
          if(result != ""){
              $("span.qtdCart").html(result);
          }
      },

      error: function(){
          
      }
  });
}

function getCart(){
  var affiliate = localStorage.getItem('affiliate');

  if(!affiliate){
      affiliate = 0;
  }

  $.ajax({
      url: "../actions/actions.php",
      type: "POST",
      data: {
          type: "getCart",
          affiliate: affiliate
      },

      beforeSend : function(){
          $(".modalCart").addClass("active");
          $(".modalCart-contentBody").addClass("loading");
          $(".modalCart-contentBody").html('<div class="loader"></div>');
      },

      success: function(result){
          if(result == "401"){
              $(".alert").addClass("active err");
              $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Faça login</span>');

              $(".modalCart").removeClass("active");
              $(".modalLogin").addClass("active");
              $("body").addClass("desactive");

              setTimeout(function(){
                  $(".alert").removeClass("active err");
                  $(".alert").html('');
              }, 1000);
          }else if(result != ""){
              $(".modalCart-contentBody").removeClass("loading");
              $(".modalCart-contentBody").html(result);
              $("body").addClass("desactive");

              getNCart();
          }else{
              $(".alert").addClass("active err");
              $(".alert").html('<span>Erro ao obter informações</span>');
              $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Erro ao obter informações</span>');

              setTimeout(function(){
                  $(".alert").removeClass("active err");
                  $(".alert").html('');
              }, 2000);
          }
      },

      error: function(){
          
      }
  });
}

$(document).on("click", ".addCart", function(){
  var idProduct = $(this).attr("idProduct");
  var type = $(this).attr("type");

  if(type == 1){
    getPasseio(idProduct);
  }else if(type == 2){
    addCart(idProduct);
  }
});