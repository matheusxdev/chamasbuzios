
setInterval(function(){
  /*if($(".bannerHeader img").is(".slide1")){
    $(".bannerHeader img").removeClass("slide1").addClass("slide2");
    $(".bannerHeader img").attr("src", "../../img/2.png");
  }else if($(".bannerHeader img").is(".slide2")){
    $(".bannerHeader img").removeClass("slide2").addClass("slide3");
    $(".bannerHeader img").attr("src", "../../img/3.png");
  }else if($(".bannerHeader img").is(".slide3")){
    $(".bannerHeader img").removeClass("slide3").addClass("slide1");
    $(".bannerHeader img").attr("src", "../../img/1.png");
  }*/
    var slides = document.querySelectorAll(".slide");
    for(var i = 0; i < slides.length; i++){
      var slideAtual = slides[i];

      if($(slideAtual).is(".active")){
        var slideNext = slides[i+1];

        $(slideAtual).removeClass("active");

        if(slideNext == undefined){
          var slideNext = slides[0];
        }

        $(slideNext).addClass("active");

        break;
      }
    }
}, 10000);
