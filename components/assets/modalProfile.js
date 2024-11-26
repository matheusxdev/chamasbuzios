$(document).on("click", ".btnProfile", function(){
  if($(".modalOrders").is(".active")){
      $(".modalOrders").removeClass("active");
      $("body").removeClass("desactive");
  }else if($(".modalProfile").is(".active")){
      $(".modalProfile").removeClass("active");
      $("body").removeClass("desactive");
  }else{
      $(".modalMenu").removeClass("active");
      $(".modalProfile").addClass("active");
      $("body").addClass("desactive");
  }
});

$(document).on("click", ".btnCloseModalProfile", function(){
  $(".modalProfile").removeClass("active");
  $("body").removeClass("desactive");
});

$(document).on("click", ".btnOrders", function(){
    $.ajax({
        url:'../actions/actions.php',
        type: "POST",
        data: {
             type: "getOrders"
        },
        beforeSend: function(){
            $(".modalOrders").addClass("active");
            $(".modalOrders-contentBody").addClass("loading");
            $(".modalOrders-contentBody").html('<div class="loader"></div>');
        },
        
        success: function(result){
            if(result == ""){
                $(".alert").addClass("active err");
                $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>'+result["message"]+'</span>');

                setTimeout(function(){
                    $(".alert").removeClass("active err");
                    $(".alert").html('');
                }, 2000);
            }else{
                $(".modalOrders-contentBody").removeClass("loading");
                $(".modalOrders-contentBody").html(result);
            }
         }
     });
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