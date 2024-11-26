function createVoucher(idOrder) {
  $.ajax({
    url:'../actions/actions.php',
    type: "POST",
    data: {
         type: "createVoucher",
         idOrder: idOrder
     },
  
     beforeSend : function(){
        
    },
    
    success: function(data){
        
     }
  });
}