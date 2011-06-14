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
    $('#main_menu ul').animate({left: 0}, "slow");
    $('#main_menu_previous').fadeOut();
    $('#main_menu_next').fadeIn();
  });
  $('#main_menu_next').live('click', function(event){
    event.preventDefault();
    $('#main_menu ul').animate({left: "-=" + (getMenuWidth() - $('#main_menu').outerWidth(true))}, "slow");
    $('#main_menu_previous').fadeIn();
    $('#main_menu_next').fadeOut();
  });

  // Form placeholder
  if(!navigator.userAgent.match('Chrome')) {
    $('input:text, textarea').focus(function(){
      if($(this).val() == $(this).attr('title')) {
        $(this).val('');
      }
    }).blur(function(){
      if(!$(this).val()) {
        $(this).val($(this).attr('title'));
      }
    }).each(function(){
      if($(this).val() == $(this).attr('title')) {
        $(this).val('');
      }
    });
  }
  else {
    $('body').addClass('chrome');
  }

  // Flashes
  $('.closestatus a').live('click', function(event){
    event.preventDefault();
    $(this).parents('.status').fadeOut();
  });

  // jqTransform
  $(".sf_admin_form select:not(.noTransform)").jqTransSelect();
  $(".sf_admin_form input:radio:not(.noTransform)").jqTransRadio();
  $(".sf_admin_form input:checkbox:not(.noTransform)").jqTransCheckBox();
  $('input:text:not(.noTransform), input:password:not(.noTransform)').jqTransInputText();
  $('textarea:not(.ckeditorDone, .noTransform)').jqTransTextarea();
  $('input:submit:not(.btn, .btnalt, .noTransform), input:reset:not(.btn, .btnalt, .noTransform), input:button:not(.btn, .btnalt, .noTransform)').jqTransInputButton();
});