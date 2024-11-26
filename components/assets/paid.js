$(document).ready(function(){
  setTimeout(function(){
    $(".orderSpinner").addClass("success");
    $(".orderSpinner").html('<i class="fa-solid fa-check"></i>');
  }, 1100);
});