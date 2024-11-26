$(document).on("click", ".btnCloseModalOrderSuccess", function(){
  $(".modalVoucher").removeClass("active");
  $(".modalOrderSuccess").removeClass("active");
  $(".modalConfirmOrder").removeClass("active");
  $(".methodsPayment").removeClass("active");
  getCart();
});