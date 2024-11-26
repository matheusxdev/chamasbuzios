setInterval(function(){
  if($(".bannerHeader img").is(".slide1")){
    $(".bannerHeader img").removeClass("slide1").addClass("slide2");
    $(".bannerHeader img").attr("src", "../../img/2.png");
  }else if($(".bannerHeader img").is(".slide2")){
    $(".bannerHeader img").removeClass("slide2").addClass("slide3");
    $(".bannerHeader img").attr("src", "../../img/3.png");
  }else if($(".bannerHeader img").is(".slide3")){
    $(".bannerHeader img").removeClass("slide3").addClass("slide1");
    $(".bannerHeader img").attr("src", "../../img/1.png");
  }
}, 10000);