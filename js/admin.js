$(document).ready(function(){
  var $addPortfolio = $('#add-portfolio');

  $addPortfolio.on('click', function(e){
    $(this).before(
      '<form action="" class="new-portfolio">'+
        '<input type="text">'+
      '</form>');
  });
});