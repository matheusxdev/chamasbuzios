$(document).on("click", ".closeModalPasseio", function(){
  $(".modalPasseio").removeClass("active");
  $("body").removeClass("desactive");
  window.history.pushState("", "Chamas Búzios", '/');
});

$(document).on("input", "#dataInput", function(){
  var dataInput = $(this).val();
  var dataHoje = $("#dataHoje").attr("data");
  var idProduct = $(this).attr("idProduct");

  var dataNew = new Date(dataInput);

  if(dataInput >= dataHoje){
      $("#dataOutput_"+idProduct).val(dataInput);
      $(".boxAlertDataInput").html("");
      $(".boxAlertDataInput").removeClass("active");
  
      $(".btnBuyReserva").attr("dataReserva", dataInput);
  }else{
      $(".boxAlertDataInput").html("DATA DEVE SER IGUAL OU MAIOR QUE HOJE");
      $(".boxAlertDataInput").addClass("active");
      $("#dataOutput_"+idProduct).val("");
  }
});

$(document).on("click", ".horaReserva", function(){
  var hourReserva = $(this).attr("hora");
  $(".horaReserva").removeClass("active");
  $(this).addClass("active");

  $(".btnBuyReserva").attr("hourReserva", hourReserva);
});

$(document).on("change", "#hourReservaPasseio", function(){
  var hourReserva = $(this).val();

  $(".btnBuyReserva").attr("hourReserva", hourReserva);
});

$(document).on("click", ".btnAlterVisitantes", function(){
  if($(".modalAlterVisitantes").is(".active")){
      $(".modalAlterVisitantes").removeClass("active");
  }else{
      $(".modalAlterVisitantes").addClass("active");
  }
});

$(document).on("click", ".closeModalAlterVisitantes", function(){
  $(".modalAlterVisitantes").removeClass("active");
  var priceTotal = $(".btnBuyReserva").attr("priceTotal");
  var adultos = $(".btnBuyReserva").attr("adultos");

  if(adultos == 1){
      if($(".boxRouteBardot").is(".active")){

      }else if($(".boxRouteAtalaia").is(".active")){

      }else{
          $("#viewPriceTotal").html("Total: R$"+priceTotal);
      }
  }else{
      $("#viewPriceTotal").html("Total: R$"+priceTotal);
  }
});

$(document).on("click", ".somQuantdAdultos", function(){
  var maxPaxes = $("#maxPaxes").val();
  var quantdAdultos = $(".quantdAdultos").html();
  var quantdTotal = $(".btnAlterVisitantes").html();
  var priceAdultos = $(".priceAdultos").attr("price");
  var priceTotal = $(".btnBuyReserva").attr("priceTotal");

  if(maxPaxes == "0"){
      maxPaxes = "999";
  }

  if(quantdTotal < maxPaxes){
      var newQuantdAdultos = parseInt(quantdAdultos)+parseInt(1);
      var newQuantdTotal = parseInt(quantdTotal)+parseInt(1);
      var newPriceTotal = parseFloat(priceTotal)+parseFloat(priceAdultos);
  
      //$("span.priceAdultos").html("R$"+newPriceTotal);
      $(".quantdAdultos").html(newQuantdAdultos);
      $(".btnBuyReserva").attr("adultos", newQuantdAdultos);
      $(".btnBuyReserva").attr("priceTotal", newPriceTotal);
      $(".btnAlterVisitantes").html(newQuantdTotal);
  }
});

$(document).on("click", ".subQuantdAdultos", function(){
  var maxPaxes = $("#maxPaxes").val();
  var quantdAdultos = $(".quantdAdultos").html();
  var quantdTotal = $(".btnAlterVisitantes").html();
  var priceAdultos = $(".priceAdultos").attr("price");
  var priceTotal = $(".btnBuyReserva").attr("priceTotal");

  if(maxPaxes == "0"){
      maxPaxes = "999";
  }

  if(quantdTotal <= maxPaxes){
      if(quantdAdultos == "1"){

      }else{
          var newQuantdAdultos = parseInt(quantdAdultos)-parseInt(1);
          var newQuantdTotal = parseInt(quantdTotal)-parseInt(1);
          var newPriceTotal = parseFloat(priceTotal)-parseFloat(priceAdultos);
  
          //$("span.priceAdultos").html("R$"+newPriceTotal);
          $(".quantdAdultos").html(newQuantdAdultos);
          $(".btnBuyReserva").attr("adultos", newQuantdAdultos);
          $(".btnBuyReserva").attr("priceTotal", newPriceTotal);
          $(".btnAlterVisitantes").html(newQuantdTotal);
      }
  }
});

$(document).on("click", ".somQuantdCriancas", function(){
  var maxPaxes = $("#maxPaxes").val();
  var quantdCriancas = $(".quantdCriancas").html();
  var quantdTotal = $(".btnAlterVisitantes").html();
  var priceCriancas = $(".priceCriancas").attr("price");
  var priceTotal = $(".btnBuyReserva").attr("priceTotal");

  if(maxPaxes == "0"){
      maxPaxes = "999";
  }

  if(quantdTotal < maxPaxes){
      var newQuantdCriancas = parseInt(quantdCriancas)+parseInt(1);
      var newQuantdTotal = parseInt(quantdTotal)+parseInt(1);
      var newPriceTotal = parseFloat(priceTotal)+parseFloat(priceCriancas);
  
      //$("span.priceCriancas").html("R$"+newPriceTotal);
      $(".quantdCriancas").html(newQuantdCriancas);
      $(".btnBuyReserva").attr("criancasPagantes", newQuantdCriancas);
      $(".btnBuyReserva").attr("priceTotal", newPriceTotal);
      $(".btnAlterVisitantes").html(newQuantdTotal);
  }
});

$(document).on("click", ".subQuantdCriancas", function(){
  var maxPaxes = $("#maxPaxes").val();
  var quantdCriancas = $(".quantdCriancas").html();
  var quantdTotal = $(".btnAlterVisitantes").html();
  var priceCriancas = $(".priceCriancas").attr("price");
  var priceTotal = $(".btnBuyReserva").attr("priceTotal");

  if(maxPaxes == "0"){
    maxPaxes = "999";
  }

  if(quantdTotal <= maxPaxes){
      if(quantdCriancas == "0"){

      }else{
          var newQuantdCriancas = parseInt(quantdCriancas)-parseInt(1);
          var newQuantdTotal = parseInt(quantdTotal)-parseInt(1);
          var newPriceTotal = parseFloat(priceTotal)-parseFloat(priceCriancas);
  
          //$("span.priceCriancas").html("R$"+newPriceTotal);
          $(".quantdCriancas").html(newQuantdCriancas);
          $(".btnBuyReserva").attr("criancasPagantes", newQuantdCriancas);
          $(".btnBuyReserva").attr("priceTotal", newPriceTotal);
          $(".btnAlterVisitantes").html(newQuantdTotal);
      }
  }
});

$(document).on("click", ".somQuantdCriancasFree", function(){
  var maxPaxes = $("#maxPaxes").val();
  var quantdCriancasFree = $(".quantdCriancasFree").html();
  var quantdTotal = $(".btnAlterVisitantes").html();
  var priceCriancasFree = $(".priceCriancasFree").attr("price");
  var priceTotal = $(".btnBuyReserva").attr("priceTotal");

  if(maxPaxes == "0"){
      maxPaxes = "999";
  }

  if(quantdTotal < maxPaxes){
      var newQuantdCriancasFree = parseInt(quantdCriancasFree)+parseInt(1);
      var newQuantdTotal = parseInt(quantdTotal)+parseInt(1);
      var newPriceTotal = parseFloat(priceTotal)+parseFloat(priceCriancasFree);
  
      $(".quantdCriancasFree").html(newQuantdCriancasFree);
      $(".btnBuyReserva").attr("criancasNaoPagantes", newQuantdCriancasFree);
      $(".btnBuyReserva").attr("priceTotal", newPriceTotal);
      $(".btnAlterVisitantes").html(newQuantdTotal);
  }
});

$(document).on("click", ".subQuantdCriancasFree", function(){
  var maxPaxes = $("#maxPaxes").val();
  var quantdCriancasFree = $(".quantdCriancasFree").html();
  var quantdTotal = $(".btnAlterVisitantes").html();
  var priceCriancasFree = $(".priceCriancasFree").attr("price");
  var priceTotal = $(".btnBuyReserva").attr("priceTotal");

  if(maxPaxes == "0"){
    maxPaxes = "999";
  }

  if(quantdTotal <= maxPaxes){
      if(quantdCriancasFree == "0"){

      }else{
          var newQuantdCriancasFree = parseInt(quantdCriancasFree)-parseInt(1);
          var newQuantdTotal = parseInt(quantdTotal)-parseInt(1);
          var newPriceTotal = parseFloat(priceTotal)-parseFloat(priceCriancasFree);
  
          $(".quantdCriancasFree").html(newQuantdCriancasFree);
          $(".btnBuyReserva").attr("criancasNaoPagantes", newQuantdCriancasFree);
          $(".btnBuyReserva").attr("priceTotal", newPriceTotal);
          $(".btnAlterVisitantes").html(newQuantdTotal);
      }
  }
});

$(document).on("click", ".somQuantdPassageiros", function(){
  var quantdPassageiros = $(".quantdPassageiros").html();
  var quantdTotal = $(".btnAlterVisitantes").html();

  if(quantdTotal == 3){

  }else{
      var newPriceTotal = 0;

      if($(".boxBardotPrice").is(".active")){
          priceOne = $(".boxBardotPrice .pricePassageiros").attr("priceOne");
          priceTwo = $(".boxBardotPrice .pricePassageiros").attr("priceTwo");
          priceThree = $(".boxBardotPrice .pricePassageiros").attr("priceThree");
      }else if($(".boxAtalaiaPrice").is(".active")){
          priceOne = $(".boxAtalaiaPrice .pricePassageiros").attr("priceOne");
          priceTwo = $(".boxAtalaiaPrice .pricePassageiros").attr("priceTwo");
          priceThree = $(".boxAtalaiaPrice .pricePassageiros").attr("priceThree");
      }
      
      var priceTotal = $(".btnBuyReserva").attr("priceTotal");
  
      var newQuantdPassageiros = parseInt(quantdPassageiros)+parseInt(1);
      var newQuantdTotal = parseInt(quantdTotal)+parseInt(1);
  
      if(newQuantdTotal == 1){
          newPriceTotal = priceOne;
      }else if(newQuantdTotal == 2){
          newPriceTotal = priceTwo*2;
      }else if(newQuantdTotal == 3){
          newPriceTotal = priceThree*3;
      }
  
      $("span.pricePassageiros").html("R$"+newPriceTotal);
      $(".quantdPassageiros").html(newQuantdPassageiros);
      $(".btnBuyReserva").attr("adultos", newQuantdPassageiros);
      $(".btnBuyReserva").attr("priceTotal", newPriceTotal);
      $(".btnAlterVisitantes").html(newQuantdTotal);
  }
});

$(document).on("click", ".subQuantdPassageiros", function(){
  var quantdPassageiros = $(".quantdPassageiros").html();
  var quantdTotal = $(".btnAlterVisitantes").html();

  if(quantdTotal == 1){

  }else if(quantdTotal > 1){
      var newPriceTotal = 0;

      if($(".boxBardotPrice").is(".active")){
          priceOne = $(".boxBardotPrice .pricePassageiros").attr("priceOne");
          priceTwo = $(".boxBardotPrice .pricePassageiros").attr("priceTwo");
          priceThree = $(".boxBardotPrice .pricePassageiros").attr("priceThree");
      }else if($(".boxAtalaiaPrice").is(".active")){
          priceOne = $(".boxAtalaiaPrice .pricePassageiros").attr("priceOne");
          priceTwo = $(".boxAtalaiaPrice .pricePassageiros").attr("priceTwo");
          priceThree = $(".boxAtalaiaPrice .pricePassageiros").attr("priceThree");
      }
      
      var priceTotal = $(".btnBuyReserva").attr("priceTotal");
  
      var newQuantdPassageiros = parseInt(quantdPassageiros)-parseInt(1);
      var newQuantdTotal = parseInt(quantdTotal)-parseInt(1);
  
      if(newQuantdTotal == 1){
          newPriceTotal = priceOne;
      }else if(newQuantdTotal == 2){
          newPriceTotal = priceTwo*2;
      }else if(newQuantdTotal == 3){
          newPriceTotal = priceThree*3;
      }
  
      $("span.pricePassageiros").html("R$"+newPriceTotal);
      $(".quantdPassageiros").html(newQuantdPassageiros);
      $(".btnBuyReserva").attr("adultos", newQuantdPassageiros);
      $(".btnBuyReserva").attr("priceTotal", newPriceTotal);
      $(".btnAlterVisitantes").html(newQuantdTotal);
  }
});

$(document).on("click", ".btnBuyReserva", function(){
  var idProduct = $(this).attr("idPasseio");
  var adultos = $(this).attr("adultos");
  var criancasPagantes = $(this).attr("criancasPagantes");
  var criancasNaoPagantes = $(this).attr("criancasNaoPagantes");
  var priceTotal = $(this).attr("priceTotal");
  var nomePasseio = $(this).attr("nomePasseio");
  var dataReserva = $(this).attr("dataReserva");
  var hourReserva = $(this).attr("hourReserva");

  var dataInput = $("#dataInput").val();
  var dataHoje = $("#dataHoje").attr("data");

  var dataNew = new Date(dataInput);

  err = 0;

  var maxPaxes = $("#maxPaxes").val();
  var minPaxes = $("#minPaxes").val();

  if(maxPaxes == "0"){
      maxPaxes = "1000000000";
  }

  var totalVisitantes = parseInt(adultos)+parseInt(criancasPagantes)+parseInt(criancasNaoPagantes);

  if(totalVisitantes < minPaxes){
      $(".alert").addClass("active err");
      $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Quantidade mínima requerida</span>');

      setTimeout(function(){
          $(".alert").removeClass("active err");
          $(".alert").html('');
      }, 2000);
  }else if(totalVisitantes > maxPaxes){
      $(".alert").addClass("active err");
      $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Quantidade máxima ultrapassada: </span>'+totalVisitantes);

      setTimeout(function(){
          $(".alert").removeClass("active err");
          $(".alert").html('');
      }, 2000);
  }else if($("#dataInput").val() == ""){
    $(".alert").addClass("active err");
    $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Escolha uma data de chegada</span>');

    setTimeout(function(){
        $(".alert").removeClass("active err");
        $(".alert").html('');
    }, 2000);
  }else if(dataInput < dataHoje){
    $(".alert").addClass("active err");
    $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Data deve ser maior ou igual a hoje</span>');

    setTimeout(function(){
        $(".alert").removeClass("active err");
        $(".alert").html('');
    }, 2000);
  }else if(hourReserva == ""){
    $(".alert").addClass("active err");
    $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Escolha um horário</span>');

    setTimeout(function(){
        $(".alert").removeClass("active err");
        $(".alert").html('');
    }, 2000);
  }else if(hourReserva == "0"){
    
    $(".alert").addClass("active err");
    $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Escolha um horário</span>');

    setTimeout(function(){
        $(".alert").removeClass("active err");
        $(".alert").html('');
    }, 2000);
  }else{
      if(err == 0){
          $(".boxAlertDataInput").html("");
          $(".boxAlertDataInput").removeClass("active");
  
          $(".boxErrHoraReserva").removeClass("active");
  
          $.ajax({
              url:'actions/actions.php',
              type: "POST",
              data: {
                  type: "addCart",
                  idProduct: idProduct,
                  adultos: adultos,
                  criancasPagantes: criancasPagantes,
                  criancasNaoPagantes: criancasNaoPagantes,
                  priceTotal: priceTotal,
                  nomePasseio: nomePasseio,
                  dataReserva: dataReserva,
                  hourReserva: hourReserva
              },
      
              beforeSend : function(){
                  $(".btnBuyReserva").html('<div class="loader"></div>');
                  $(".btnBuyReserva").addClass("loading");
              },
              
              success: function(result){
                  result = JSON.parse(result);
                      
                  if(result["err"] == "0"){
                      $(".alert").addClass("active success");
                      $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');
                      $(".btnBuyReserva").html('Adicionar ao carrinho');
      
                      setTimeout(function(){
                          $(".alert").removeClass("active success");
                          $(".alert").html('');
                          $(".navHeader").show().fadeIn();
                          $(".modalPasseio").removeClass("active");
                          $(".body").removeClass("desactive");
                          window.history.pushState("", "Destino Tour Búzios", '/');
                          getCart();
                      }, 1000);
                  }else if(result["err"] == "401"){
                      $(".alert").addClass("active err");
                      $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Faça login</span>');

                      $(".modalPasseio").removeClass("active");
                      $(".modalLogin").addClass("active");

                      $(".btnBuyReserva").html('Adicionar ao carrinho');
      
                      setTimeout(function(){
                          $(".alert").removeClass("active err");
                          $(".alert").html('');
                      }, 1000);
                  }else{
                      $(".alert").addClass("active err");
                      $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');
                      $(".btnBuyReserva").html('Adicionar ao carrinho');
      
                      setTimeout(function(){
                          $(".alert").removeClass("active err");
                          $(".alert").html('');
                      }, 1000);
                  }
              }
          });
      }
  }
});