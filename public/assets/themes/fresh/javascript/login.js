jQuery(function($){
  $('#loginUsername').focus();
  $('.flash-message').hover(
    function() { $(this).find('.hide-flash').css('visibility', 'visible'); },
    function() { $(this).find('.hide-flash').css('visibility', 'hidden'); }
  );

  $('.flash-message').click(function() { $(this).slideUp(); });

  $('#loginOptionsLink a').click(function() {
    if ('»' == $(this).find('span').html())
      $(this).find('span').html('&laquo;');
    else
      $(this).find('span').html('&raquo;');
    $('#options1').slideToggle();
    $('#options2').slideToggle();
  });
});
