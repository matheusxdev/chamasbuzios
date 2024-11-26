$(document).ready(function(){
  setTimeout(function(){
    $('input, input[type="text"], select').val("");
}, 1000);
});

function openLink(link){
  console.log(link);
  window.open(link, "_blank");
}