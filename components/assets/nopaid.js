$(document).ready(function(){
  setTimeout(function(){
    $(".orderSpinner").addClass("err");
    $(".orderSpinner").html('<i class="fa-solid fa-x"></i>');
  }, 1100);
});