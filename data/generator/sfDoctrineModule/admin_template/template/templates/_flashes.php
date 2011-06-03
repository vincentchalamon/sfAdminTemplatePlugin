[?php if ($sf_user->hasFlash('notice')): ?]
  <div class="status success">
    <p class="closestatus"><a href="#" title="Close">x</a></p>
    <p>[?php echo image_tag(public_path('/sfAdminTemplatePlugin/images/icon_success.png'), array('alt' => 'Success', 'title' => 'Success')) ?]<span>Success!</span> [?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?]</p>
  </div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('error')): ?]
  <div class="status error">
    <p class="closestatus"><a href="#" title="Close">x</a></p>
    <p>[?php echo image_tag(public_path('/sfAdminTemplatePlugin/images/icon_error.png'), array('alt' => 'Error', 'title' => 'Error')) ?]<span>Error!</span> [?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?]</p>
  </div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('warning')): ?]
  <div class="status warning">
    <p class="closestatus"><a href="#" title="Close">x</a></p>
    <p>[?php echo image_tag(public_path('/sfAdminTemplatePlugin/images/icon_warning.png'), array('alt' => 'Warning', 'title' => 'Warning')) ?]<span>Warning!</span> [?php echo __($sf_user->getFlash('warning'), array(), 'sf_admin') ?]</p>
  </div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('info')): ?]
  <div class="status info">
    <p class="closestatus"><a href="#" title="Close">x</a></p>
    <p>[?php echo image_tag(public_path('/sfAdminTemplatePlugin/images/icon_info.png'), array('alt' => 'Information', 'title' => 'Information')) ?]<span>Information!</span> [?php echo __($sf_user->getFlash('info'), array(), 'sf_admin') ?]</p>
  </div>
[?php endif; ?]
