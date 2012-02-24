<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <!--[if IE 6]>
      <script type='text/javascript' src='/sfAdminTemplatePlugin/js/png_fix.js'></script>
      <script type='text/javascript'>
        DD_belatedPNG.fix('img, .notifycount, .selected');
      </script>
    <![endif]-->
  </head>
  <body>
    <!-- Wrapper Start -->
    <div id="wrapper">
      <div id="header">
        <?php echo link_to(image_tag(public_path('/sfAdminTemplatePlugin/images/cp_logo.png'), array('title' => 'Control Panel', 'title' => 'Control Panel', 'class' => 'logo')), "@homepage", array('title' => 'Control Panel')) ?>
        <?php if($sf_user->isAuthenticated()): ?>
          <div class="user">
            <?php echo link_to(image_tag(public_path('/sfAdminTemplatePlugin/images/avatar.png'), array('class' => 'hoverimg', 'height' => 44, 'width' => 44, 'alt' => 'Avatar', 'title' => 'Avatar')), "@sf_guard_user_edit?id=".$sf_user->getGuardUser()->getPrimaryKey()) ?>
            <p class="username"><?php echo link_to($sf_user->getGuardUser()->getUsername(), "@sf_guard_user_edit?id=".$sf_user->getGuardUser()->getPrimaryKey()) ?></p>
            <p class="userbtn"><?php echo link_to("Déconnexion", "@sf_guard_signout", array('title' => 'Déconnexion')) ?></p>
            <p class="userbtn"><?php echo link_to("Mon compte", "@sf_guard_user_edit?id=".$sf_user->getGuardUser()->getPrimaryKey(), array('title' => 'Mon compte')) ?></p>
          </div>
        <?php endif ?>
        <?php if(is_file(sfConfig::get('sf_app_template_dir').'/_header.php')): ?>
          <?php include_partial("global/header") ?>
        <?php endif ?>
      </div>

      <?php if($sf_user->isAuthenticated()): ?>
        <?php $menus = sfConfig::get('app_sf_admin_template_menus', array()) ?>
        <?php if(count($menus)): ?>
          <!-- Top Menu Start -->
          <div id="main_menu">
            <div>
              <ul>
                <?php foreach($menus as $name => $options): ?>
                  <?php if(!isset($options['credentials']) || !count($options['credentials']) || $sf_user->hasCredential($options['credentials'])): ?>
                    <?php if(!isset($options['route_prefix'])) $options['route_prefix'] = $name ?>
                    <li<?php if(get_slot('menu') == $options['route_prefix']): ?> class="current"<?php endif ?>><?php echo link_to($options['label'], '@'.$options['route_prefix'], array('title' => $options['label'])) ?></li>
                  <?php endif ?>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
          <!-- Top Menu End -->
        <?php endif ?>
      <?php endif ?>

      <?php $breadcrumb = get_slot('breadcrumb', array()) ?>
      <?php if(count($breadcrumb)): ?>
        <!-- Top Breadcrumb Start -->
        <div id="breadcrumb">
          <ul>
            <li><?php echo image_tag(public_path('/sfAdminTemplatePlugin/images/icon_breadcrumb.png'), array('alt' => 'Location', 'title' => 'Location')) ?></li>
            <li><strong>Vous êtes ici:</strong></li>
            <?php foreach($breadcrumb as $key => $node): ?>
              <?php if($key < count($breadcrumb)-1): ?>
                <li><?php echo link_to($node['label'], $node['url'], array('title' => $node['label'])) ?></li>
                <li>/</li>
              <?php else: ?>
                <li class="current"><?php echo link_to($node['label'], $node['url'], array('title' => $node['label'])) ?></li>
              <?php endif ?>
            <?php endforeach ?>
          </ul>
        </div>
        <!-- Top Breadcrumb End -->
      <?php endif ?>

      <!-- Container Start -->
      <div id="container">
        <?php echo $sf_content ?>
      </div>
      <!-- Container End -->

      <!-- Content Box End -->
      <div id="footer">
        &copy; Copyright <?php echo date('Y') ?> <?php echo $sf_request->getHost() ?>
      </div>
    </div>
    <!-- Wrapper End -->
  </body>
</html>