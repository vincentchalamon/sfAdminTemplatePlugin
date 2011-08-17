function getMenuWidth()
{
  var width = 0;
  $('#main_menu li').each(function(){
    width += $(this).outerWidth(true);
  });
  return width;
}

$(document).ready(function(){
  // Main menu
  if(getMenuWidth() > $('#main_menu').outerWidth(true))
  {
    $('#main_menu').append($('<a href="#" id="main_menu_previous" style="display: none;">&lang;</a>'));
    $('#main_menu').prepend($('<a href="#" id="main_menu_next">&rang;</a>'));
  }
  $('#main_menu_previous').live('click', function(event){
    event.preventDefault();
    if(parseInt($('#main_menu ul').css('left')) + $('#main_menu div:first').outerWidth(true) >= 0) {
      $('#main_menu_previous').hide();
    }
    $('#main_menu ul').animate({left: "+=" + $('#main_menu div:first').outerWidth(true)}, "slow");
    $('#main_menu_next').show();
  });
  $('#main_menu_next').live('click', function(event){
    event.preventDefault();
    if(-parseInt($('#main_menu ul').css('left'))+($('#main_menu div:first').outerWidth(true)*2) >= getMenuWidth()) {
      $('#main_menu_next').hide();
    }
    $('#main_menu ul').animate({left: "-=" + $('#main_menu div:first').outerWidth(true)}, "slow");
    $('#main_menu_previous').show();
  });

  // Login form
  $('form').live('submit', function(){
    $('input:submit:not(.noRemove)', $(this)).hide();
    $('.loading:first', $(this)).show();
  }).validationEngine();

  // Form placeholder
  if(navigator.userAgent.match('Chrome')) {
    $('body').addClass('chrome');
  }

  // Flashes
  $('.closestatus a').live('click', function(event){
    event.preventDefault();
    $(this).parents('.status').fadeOut();
  });

  // Fancybox
  $('.fancybox').fancybox({
    overlayColor: "#000",
    padding: 0,
    margin: 0
  });

  // jqTransform
  $(".sf_admin_form select:visible:not(.noTransform)").jqTransSelect();
  $(".sf_admin_form input:visible:radio:not(.noTransform)").jqTransRadio();
  $(".sf_admin_form input:visible:checkbox:not(.noTransform)").jqTransCheckBox();
  $('input:visible:text:not(.noTransform), input:visible:password:not(.noTransform)').jqTransInputText();
  $('textarea:visible:not(.ckeditorDone, .noTransform)').autoResize();
  $('textarea:visible:not(.ckeditorDone, .noTransform, [id$=_autoresize])').jqTransTextarea();
  $('input:visible:submit:not(.btn, .btnalt, .noTransform), input:visible:reset:not(.btn, .btnalt, .noTransform), input:visible:button:not(.btn, .btnalt, .noTransform)').jqTransInputButton();
});