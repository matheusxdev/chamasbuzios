$(document).on("click", ".btnCart", function(){
    $("body").addClass("desactive");
    $(".modalCart").addClass("active");

    if($(".boxSearch").is(".active")){
        $(".boxSearch").removeClass("active");
    }

    var affiliate = localStorage.getItem('affiliate');

    if(!affiliate){
        affiliate = 0;
    }

    $.ajax({
        url: "./actions/actions.php",
        type: "POST",
        data: {
            type: "getCart",
            affiliate: affiliate
        },

        beforeSend : function(){
            $(".modalCart-contentBody").addClass("loading");
            $(".modalCart-contentBody").html('<div class="loader"></div>');
        },

        success: function(result){
            if(result == "401"){
                $(".alert").addClass("active err");
                $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Faça login</span>');

                $(".modalCart").removeClass("active");
                $(".modalLogin").addClass("active");

                setTimeout(function(){
                    $(".alert").removeClass("active err");
                    $(".alert").html('');
                }, 1000);
            }else if(result != ""){
                $(".modalCart-contentBody").removeClass("loading");
                $(".modalCart-contentBody").html(result);
            }else {
                $(".alert").addClass("active err");
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
});

var temporiza;
$(document).on("input", "#inputSearch", function(e){
    e.preventDefault();

    var text = $(this).val();
    var verify = text.indexOf("@", 0);
    if(verify <= "0"){
        var text = text.replace(/@/g, "");
    }

    clearTimeout(temporiza);
    temporiza = setTimeout(function(){
        if(text == ""){
            $(".btnSearch").html('<i class="fa-solid fa-magnifying-glass"></i>');
            $(".modalSearch").removeClass("active");
            //$(".feed").removeClass("desactive");
        }else{
            $.ajax({
                url: '../actions/actions.php',
                type: 'POST',
                data: {
                    type: "searchShop",
                    text: text
                },
    
                beforeSend : function(){
                    $(".btnSearch").html("<div class='loader'></div>");
                },
        
                success: function(retorno){
                    if(retorno == "err"){
                        $(".btnSearch").html('<i class="fa-solid fa-magnifying-glass"></i>');
                        $(".modalSearch").removeClass("active");
                        //$(".feed").addClass("desactive");
                        $(".modalSearch-content").html("");
                    }else if(retorno){
                        $(".btnSearch").html('<i class="fa-solid fa-magnifying-glass"></i>');
                        $(".modalSearch").addClass("active");
                        //$(".feed").addClass("desactive");
                        $(".modalSearch-content").html(retorno);
                    }else{
                        $(".alert").addClass("active err");
                        $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Ocorreu um erro ao pesquisar</span>');

                        $(".modalSearch").removeClass("active");
                        $(".btnSearch").html('<i class="fa-solid fa-magnifying-glass"></i>');
                        
                        setTimeout(function(){
                            $(".alert").removeClass("active err");
                            $(".alert").html('');
                        }, 2000);
                    }
                },
        
                error: function(){
                    $(".alert").addClass("active err");
                    $(".alert").html('<div class="icon"><i class="fa-solid fa-circle-info"></i></div><span>Ocorreu um erro ao pesquisar</span>');

                    $(".modalSearch").removeClass("active");
                    $(".btnSearch").html('<i class="fa-solid fa-magnifying-glass"></i>');
                    
                    setTimeout(function(){
                        $(".alert").removeClass("active err");
                        $(".alert").html('');
                    }, 2000);
                }
            });
        }
    }, 1000);
});