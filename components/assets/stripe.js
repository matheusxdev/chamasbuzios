function validPayment(idPayment, idOrder){
  if(idPayment != "" || idOrder != ""){
    $.ajax({
      url: "./components/payments/stripe.php",
      type: "POST",
      data: {
          type: "validPayment",
          idPayment: idPayment,
          idOrder: idOrder,
      },
    
      beforeSend : function(){
          $(".modalOrderSuccess-contentBody").addClass("loading");
          $(".modalOrderSuccess-contentBody").html("<div class='loader'></div>");
      },
      
      success: function(data){
        
      }
    });

    setTimeout(function(){
      $.ajax({
        url: "./actions/actions.php",
        type: "POST",
        data: {
            type: "redirectStripe",
            idPayment: idPayment,
            idOrder: idOrder,
        },
      
        beforeSend : function(){
            $(".modalOrderSuccess-contentBody").addClass("loading");
            $(".modalOrderSuccess-contentBody").html("<div class='loader'></div>");
        },
        
        success: function(data){
            
        }
      });
    }, 500);
  }
}